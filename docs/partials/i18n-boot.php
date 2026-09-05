<?php
/**
 * Language detection + translation helpers.
 *
 * Included before <html> so $currentLang can drive the lang attribute and all
 * body copy is rendered server-side in the right language. This is the single
 * source of truth for visible text: pages must not hardcode copy.
 */
declare(strict_types=1);

const SUPPORTED_LANGS = ['nl', 'en', 'de'];
const DEFAULT_LANG    = 'nl';

$requestPath = strtok((string) ($_SERVER['REQUEST_URI'] ?? '/'), '?');

// Language comes from the URL prefix only. The cookie/Accept-Language fallback
// lives in nginx, which redirects / to /<lang>/ before we ever get here.
preg_match('#^/([a-z]{2})(?:/|$)#', $requestPath, $m);
$currentLang = (isset($m[1]) && in_array($m[1], SUPPORTED_LANGS, true)) ? $m[1] : DEFAULT_LANG;

// Path with the language prefix stripped, e.g. /en/jobs -> /jobs, /nl/ -> /
$pagePath = preg_replace('#^/[a-z]{2}(?=/|$)#', '', $requestPath) ?: '/';
if ($pagePath !== '/') {
    $pagePath = '/' . trim($pagePath, '/');
}

$translationsFile = __DIR__ . '/../locales/translations.json';
$allTranslations  = is_readable($translationsFile)
    ? (json_decode((string) file_get_contents($translationsFile), true) ?: [])
    : [];
$translations = $allTranslations[$currentLang] ?? [];
$fallbackTranslations = $allTranslations[DEFAULT_LANG] ?? [];

/**
 * Look up a translation key. Keys are flat ("hero.title") except for the
 * nested "meta" group, so we try the literal key first and then walk the path.
 */
function t(string $key, string $fallback = ''): string
{
    global $translations, $fallbackTranslations;

    foreach ([$translations, $fallbackTranslations] as $table) {
        if (isset($table[$key]) && is_string($table[$key])) {
            return $table[$key];
        }
        $value = $table;
        foreach (explode('.', $key) as $segment) {
            if (!is_array($value) || !isset($value[$segment])) {
                $value = null;
                break;
            }
            $value = $value[$segment];
        }
        if (is_string($value)) {
            return $value;
        }
    }

    return $fallback !== '' ? $fallback : $key;
}

/** Escape for HTML text/attribute context. */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Translate and escape — the default for rendering copy. */
function te(string $key, string $fallback = ''): string
{
    return e(t($key, $fallback));
}

/** Build a language-prefixed URL for the given site-relative path. */
function langUrl(string $path, ?string $lang = null): string
{
    global $currentLang;
    $lang = $lang ?? $currentLang;
    $path = '/' . ltrim($path, '/');
    return $path === '/' ? "/{$lang}/" : "/{$lang}{$path}";
}

/**
 * Canonical origin. HTTP_HOST is attacker-controlled, so prefer an explicit
 * SITE_ORIGIN and only fall back to the request host for local development.
 */
function siteOrigin(): string
{
    $configured = getenv('SITE_ORIGIN');
    if (is_string($configured) && $configured !== '') {
        return rtrim($configured, '/');
    }

    $forwardedProto = (string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '');
    $scheme = $forwardedProto !== ''
        ? explode(',', $forwardedProto)[0]
        : ((($_SERVER['HTTPS'] ?? '') === 'on') ? 'https' : 'http');

    $host = (string) ($_SERVER['HTTP_HOST'] ?? 'localhost');
    if (!preg_match('/^[A-Za-z0-9.\-]+(:\d+)?$/', $host)) {
        $host = 'localhost';
    }

    return trim($scheme) . '://' . $host;
}

/** True once the visitor has opted in to analytics. */
function analyticsConsented(): bool
{
    return ($_COOKIE['analyticsConsent'] ?? '') === 'granted';
}
