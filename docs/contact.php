<?php
declare(strict_types=1);

function env_value(string $key, ?string $default = null): ?string
{
    $value = getenv($key);
    if ($value === false || $value === '') {
        return $default;
    }
    return $value;
}

function sanitize_single_line(string $value): string
{
    $value = trim($value);
    return preg_replace('/[\r\n]+/', ' ', $value);
}

function value_or_na(string $value): string
{
    return $value !== '' ? $value : 'n/a';
}

function smtp_expect($socket, int $code)
{
    $response = '';
    while (($line = fgets($socket, 515)) !== false) {
        $response .= $line;
        if (isset($line[3]) && $line[3] === ' ') {
            break;
        }
    }

    if (strpos($response, (string) $code) !== 0) {
        return $response !== '' ? $response : 'SMTP error';
    }

    return true;
}

function smtp_command($socket, string $command, int $expect)
{
    fwrite($socket, $command . "\r\n");
    return smtp_expect($socket, $expect);
}

function smtp_send(
    string $host,
    int $port,
    string $user,
    string $pass,
    string $from,
    string $to,
    string $subject,
    string $body,
    bool $useTls
): array {
    $errno = 0;
    $errstr = '';
    $socket = fsockopen($host, $port, $errno, $errstr, 10);
    if (!$socket) {
        return [false, "SMTP connect failed: {$errstr} ({$errno})"];
    }

    stream_set_timeout($socket, 10);
    $result = smtp_expect($socket, 220);
    if ($result !== true) {
        fclose($socket);
        return [false, $result];
    }

    $helo = env_value('SMTP_HELO', 'localhost');
    $result = smtp_command($socket, "EHLO {$helo}", 250);
    if ($result !== true) {
        fclose($socket);
        return [false, $result];
    }

    if ($useTls) {
        $result = smtp_command($socket, 'STARTTLS', 220);
        if ($result !== true) {
            fclose($socket);
            return [false, $result];
        }

        if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
            fclose($socket);
            return [false, 'Failed to enable TLS'];
        }

        $result = smtp_command($socket, "EHLO {$helo}", 250);
        if ($result !== true) {
            fclose($socket);
            return [false, $result];
        }
    }

    if ($user !== '' && $pass !== '') {
        $result = smtp_command($socket, 'AUTH LOGIN', 334);
        if ($result !== true) {
            fclose($socket);
            return [false, $result];
        }

        $result = smtp_command($socket, base64_encode($user), 334);
        if ($result !== true) {
            fclose($socket);
            return [false, $result];
        }

        $result = smtp_command($socket, base64_encode($pass), 235);
        if ($result !== true) {
            fclose($socket);
            return [false, $result];
        }
    }

    $result = smtp_command($socket, "MAIL FROM:<{$from}>", 250);
    if ($result !== true) {
        fclose($socket);
        return [false, $result];
    }

    $result = smtp_command($socket, "RCPT TO:<{$to}>", 250);
    if ($result !== true) {
        fclose($socket);
        return [false, $result];
    }

    $result = smtp_command($socket, 'DATA', 354);
    if ($result !== true) {
        fclose($socket);
        return [false, $result];
    }

    $headers = [
        "From: {$from}",
        "To: {$to}",
        "Subject: {$subject}",
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
    ];

    $normalizedBody = str_replace(["\r\n", "\r"], "\n", $body);
    $normalizedBody = preg_replace('/^\./m', '..', $normalizedBody);
    $data = implode("\r\n", $headers) . "\r\n\r\n" . $normalizedBody;
    fwrite($socket, $data . "\r\n.\r\n");

    $result = smtp_expect($socket, 250);
    if ($result !== true) {
        fclose($socket);
        return [false, $result];
    }

    smtp_command($socket, 'QUIT', 221);
    fclose($socket);
    return [true, ''];
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Method not allowed.';
    exit;
}

$honeypot = trim((string) ($_POST['website'] ?? ''));
if ($honeypot !== '') {
    http_response_code(400);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Invalid submission.';
    exit;
}

$fullName = trim((string) ($_POST['full_name'] ?? ''));
$company = trim((string) ($_POST['company'] ?? ''));
$eventDate = trim((string) ($_POST['event_date'] ?? ''));
$attendees = trim((string) ($_POST['attendees'] ?? ''));
$location = trim((string) ($_POST['location'] ?? ''));
$notes = trim((string) ($_POST['notes'] ?? ''));

if ($fullName === '' && $company === '' && $eventDate === '' && $attendees === '' && $location === '' && $notes === '') {
    http_response_code(400);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Please fill in the form.';
    exit;
}

$subjectName = sanitize_single_line($fullName);
$subject = 'JarnoWiFi contact request';
if ($subjectName !== '') {
    $subject .= ' - ' . $subjectName;
}

$bodyLines = [
    'New contact request',
    '',
    'Name: ' . value_or_na($fullName),
    'Company: ' . value_or_na($company),
    'Event date: ' . value_or_na($eventDate),
    'Estimated attendees: ' . value_or_na($attendees),
    'Location: ' . value_or_na($location),
    'Notes: ' . value_or_na($notes),
    '',
    'Submitted: ' . date('c'),
    'IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'),
];

$body = implode("\n", $bodyLines);

$host = 'mail.treudler.net';
$user = 'system@pilowifi.net';
$from = 'system@pilowifi.net';
$secure = 'tls';
$useTls = true;
$port = 587;
$pass = env_value('SMTP_PASS', '');
$to = 'contact@pilowifi.net';

[$ok, $error] = smtp_send($host, $port, $user ?? '', $pass ?? '', $from ?? 'system@pilowifi.net', $to, $subject, $body, $useTls);

if (!$ok) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Email sending failed. ' . $error;
    exit;
}

$lang = sanitize_single_line((string) ($_POST['lang'] ?? ''));
if (!in_array($lang, ['nl', 'en', 'de'], true)) {
    $lang = 'nl';
}

header('Location: index.html?lang=' . $lang . '#contact');
header('Content-Type: text/plain; charset=UTF-8');
echo 'Message sent.';
