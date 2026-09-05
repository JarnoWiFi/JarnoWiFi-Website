<?php
/**
 * Contact form handler.
 *
 * Responses never expose SMTP configuration or server dialogue — failures are
 * logged server-side and the client only learns that sending failed.
 */
declare(strict_types=1);

require __DIR__ . '/partials/i18n-boot.php';

const MAX_NAME_LENGTH  = 120;
const MAX_EMAIL_LENGTH = 200;
const MAX_NOTES_LENGTH = 5000;
const RATE_LIMIT_MAX   = 5;      // submissions per window, per IP
const RATE_LIMIT_WINDOW = 3600;  // seconds

function env_value(string $key, string $default = ''): string
{
    $value = getenv($key);
    return ($value === false || $value === '') ? $default : $value;
}

function wants_json(): bool
{
    $accept = (string) ($_SERVER['HTTP_ACCEPT'] ?? '');
    $requested = strtolower((string) ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? ''));
    return str_contains($accept, 'application/json')
        || $requested === 'fetch'
        || $requested === 'xmlhttprequest';
}

function respond(int $status, bool $ok, string $message): never
{
    http_response_code($status);
    if (wants_json()) {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(['ok' => $ok, 'message' => $message]);
        exit;
    }
    header('Content-Type: text/plain; charset=UTF-8');
    echo $message;
    exit;
}

function sanitize_single_line(string $value): string
{
    return trim((string) preg_replace('/[\r\n]+/', ' ', $value));
}

/** Simple per-IP file-based throttle; keeps the endpoint from being a relay. */
function rate_limited(string $ip): bool
{
    $dir = sys_get_temp_dir() . '/jarnowifi-contact';
    if (!is_dir($dir) && !@mkdir($dir, 0700, true) && !is_dir($dir)) {
        return false; // fail open rather than block legitimate mail
    }

    $file = $dir . '/' . hash('sha256', $ip);
    $now = time();
    $hits = [];
    if (is_readable($file)) {
        $hits = array_filter(
            (array) json_decode((string) file_get_contents($file), true),
            static fn($ts) => is_int($ts) && $ts > $now - RATE_LIMIT_WINDOW
        );
    }
    if (count($hits) >= RATE_LIMIT_MAX) {
        return true;
    }
    $hits[] = $now;
    @file_put_contents($file, json_encode(array_values($hits)), LOCK_EX);
    return false;
}

/**
 * Minimal SMTP client.
 * @return array{0: bool, 1: string} [success, internal error detail]
 */
function smtp_send(array $config, string $to, string $subject, string $body, string $replyTo): array
{
    $expect = static function ($socket, int $code) {
        $response = '';
        while (($line = fgets($socket, 515)) !== false) {
            $response .= $line;
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        return str_starts_with($response, (string) $code) ? true : ($response ?: 'no response');
    };
    $command = static function ($socket, string $line, int $code) use ($expect) {
        fwrite($socket, $line . "\r\n");
        return $expect($socket, $code);
    };

    $socket = @fsockopen($config['host'], $config['port'], $errno, $errstr, 10);
    if (!$socket) {
        return [false, "connect failed: {$errstr} ({$errno})"];
    }
    stream_set_timeout($socket, 10);

    $steps = [
        [null, 220],
        ["EHLO {$config['helo']}", 250],
    ];
    foreach ($steps as [$line, $code]) {
        $result = $line === null ? $expect($socket, $code) : $command($socket, $line, $code);
        if ($result !== true) {
            fclose($socket);
            return [false, (string) $result];
        }
    }

    if ($config['tls']) {
        foreach ([['STARTTLS', 220]] as [$line, $code]) {
            if (($result = $command($socket, $line, $code)) !== true) {
                fclose($socket);
                return [false, (string) $result];
            }
        }
        if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
            fclose($socket);
            return [false, 'failed to enable TLS'];
        }
        if (($result = $command($socket, "EHLO {$config['helo']}", 250)) !== true) {
            fclose($socket);
            return [false, (string) $result];
        }
    }

    if ($config['user'] !== '' && $config['pass'] !== '') {
        foreach ([
            ['AUTH LOGIN', 334],
            [base64_encode($config['user']), 334],
            [base64_encode($config['pass']), 235],
        ] as [$line, $code]) {
            if (($result = $command($socket, $line, $code)) !== true) {
                fclose($socket);
                return [false, (string) $result];
            }
        }
    }

    foreach ([
        ["MAIL FROM:<{$config['from']}>", 250],
        ["RCPT TO:<{$to}>", 250],
        ['DATA', 354],
    ] as [$line, $code]) {
        if (($result = $command($socket, $line, $code)) !== true) {
            fclose($socket);
            return [false, (string) $result];
        }
    }

    $headers = [
        'From: JarnoWiFi website <' . $config['from'] . '>',
        'To: ' . $to,
        'Reply-To: ' . $replyTo,
        'Subject: ' . $subject,
        'Date: ' . date('r'),
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
    ];
    $normalized = str_replace(["\r\n", "\r"], "\n", $body);
    $normalized = (string) preg_replace('/^\./m', '..', $normalized);
    fwrite($socket, implode("\r\n", $headers) . "\r\n\r\n" . $normalized . "\r\n.\r\n");

    if (($result = $expect($socket, 250)) !== true) {
        fclose($socket);
        return [false, (string) $result];
    }

    $command($socket, 'QUIT', 221);
    fclose($socket);
    return [true, ''];
}

// ---------------------------------------------------------------- request

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    respond(405, false, 'Method not allowed.');
}

$clientIp = (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
if (rate_limited($clientIp)) {
    respond(429, false, 'Too many requests. Please try again later.');
}

// Honeypot: bots fill this, humans never see it.
if (trim((string) ($_POST['website'] ?? '')) !== '') {
    respond(400, false, 'Invalid submission.');
}

$fullName = mb_substr(sanitize_single_line((string) ($_POST['full_name'] ?? '')), 0, MAX_NAME_LENGTH);
$email    = mb_substr(sanitize_single_line((string) ($_POST['email'] ?? '')), 0, MAX_EMAIL_LENGTH);
$notes    = mb_substr(trim((string) ($_POST['notes'] ?? '')), 0, MAX_NOTES_LENGTH);

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(400, false, 'Please provide a valid email address.');
}
if ($notes === '') {
    respond(400, false, 'Please provide a message.');
}

$lang = (string) ($_POST['lang'] ?? '');
if (!in_array($lang, SUPPORTED_LANGS, true)) {
    $lang = DEFAULT_LANG;
}

$subject = 'JarnoWiFi contact request' . ($fullName !== '' ? ' - ' . $fullName : ' - ' . $email);
$body = implode("\n", [
    'New contact request',
    '',
    'Name:     ' . ($fullName !== '' ? $fullName : 'n/a'),
    'Email:    ' . $email,
    'Language: ' . $lang,
    '',
    'Message:',
    $notes,
    '',
    '--',
    'Submitted: ' . date('c'),
    'IP:        ' . $clientIp,
]);

$config = [
    'host' => env_value('SMTP_HOST', 'mail.treudler.net'),
    'port' => (int) env_value('SMTP_PORT', '587'),
    'user' => env_value('SMTP_USER', 'system@treudler.net'),
    'pass' => env_value('SMTP_PASS'),
    'from' => env_value('SMTP_FROM', 'system@treudler.net'),
    'helo' => env_value('SMTP_HELO', 'jarnowifi.net'),
    'tls'  => env_value('SMTP_TLS', '1') !== '0',
];
$recipient = env_value('CONTACT_RECIPIENT', 'contact@jarnowifi.net');

if ($config['pass'] === '') {
    error_log('[contact] SMTP_PASS is not configured; cannot send mail.');
    respond(500, false, 'Email sending failed.');
}

[$ok, $error] = smtp_send($config, $recipient, $subject, $body, $email);

if (!$ok) {
    // Detail stays in the server log; the client gets a generic failure.
    error_log('[contact] SMTP send failed: ' . $error);
    respond(500, false, 'Email sending failed.');
}

if (wants_json()) {
    respond(200, true, 'Message sent.');
}

header('Location: ' . ($lang === '' ? '/' : "/{$lang}/") . '?sent=1#contact', true, 303);
exit;
