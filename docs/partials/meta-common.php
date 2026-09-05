<?php
/**
 * Shared <head> contents. Expects i18n-boot.php to have run already (pages
 * include it above <html> so $currentLang can set the lang attribute).
 *
 * Pages may set, before including this file:
 *   $metaTitleKey / $metaTitle, $metaDescriptionKey / $metaDescription,
 *   $metaImage, $metaType, $jsonLd
 */
declare(strict_types=1);

$origin = siteOrigin();

$computedTitle = isset($metaTitleKey) && $metaTitleKey !== ''
    ? t($metaTitleKey)
    : ($metaTitle ?? t('meta.title'));

$computedDescription = isset($metaDescriptionKey) && $metaDescriptionKey !== ''
    ? t($metaDescriptionKey)
    : ($metaDescription ?? t('meta.description'));

// Descriptions over ~155 chars get truncated in search results.
if (mb_strlen($computedDescription) > 155) {
    $computedDescription = rtrim(mb_substr($computedDescription, 0, 152), " ,.;:—-") . '…';
}

// Canonical deliberately excludes the query string so tracking parameters
// consolidate onto one URL instead of self-canonicalising.
$canonicalPath = $pagePath === '/' ? "/{$currentLang}/" : "/{$currentLang}{$pagePath}";
$canonicalUrl  = $origin . $canonicalPath;

$rawImage = $metaImage ?? '/img/og-default.png';
$imageUrl = preg_match('#^https?://#', $rawImage) ? $rawImage : $origin . $rawImage;

$ogLocale = ['nl' => 'nl_NL', 'en' => 'en_US', 'de' => 'de_DE'][$currentLang] ?? 'nl_NL';
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="theme-color" content="#020617" />

<title><?= e($computedTitle) ?></title>
<meta name="description" content="<?= e($computedDescription) ?>" />
<link rel="canonical" href="<?= e($canonicalUrl) ?>" />

<link rel="icon" href="/favicon.svg" type="image/svg+xml" />
<link rel="icon" href="/favicon.ico" sizes="32x32" />
<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
<link rel="manifest" href="/site.webmanifest" />

<meta property="og:type" content="<?= e($metaType ?? 'website') ?>" />
<meta property="og:site_name" content="JarnoWiFi" />
<meta property="og:title" content="<?= e($computedTitle) ?>" />
<meta property="og:description" content="<?= e($computedDescription) ?>" />
<meta property="og:url" content="<?= e($canonicalUrl) ?>" />
<meta property="og:image" content="<?= e($imageUrl) ?>" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image:alt" content="<?= te('meta.title') ?>" />
<meta property="og:locale" content="<?= e($ogLocale) ?>" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?= e($computedTitle) ?>" />
<meta name="twitter:description" content="<?= e($computedDescription) ?>" />
<meta name="twitter:image" content="<?= e($imageUrl) ?>" />

<?php foreach (SUPPORTED_LANGS as $altLang): ?>
<link rel="alternate" hreflang="<?= e($altLang) ?>" href="<?= e($origin . ($pagePath === '/' ? "/{$altLang}/" : "/{$altLang}{$pagePath}")) ?>" />
<?php endforeach; ?>
<link rel="alternate" hreflang="x-default" href="<?= e($origin . ($pagePath === '/' ? '/nl/' : "/nl{$pagePath}")) ?>" />

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Work+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
<link href="/site.css" rel="stylesheet" />
<?php if (!empty($preloadImage)): ?>
<link rel="preload" as="image" href="<?= e($preloadImage) ?>" fetchpriority="high" />
<?php endif; ?>

<script type="application/ld+json">
<?= json_encode(array_merge([
    '@context' => 'https://schema.org',
    '@type'    => 'ProfessionalService',
    '@id'      => $origin . '/#business',
    'name'     => 'JarnoWiFi',
    'url'      => $origin . '/',
    'description' => t('meta.description'),
    'image'    => $imageUrl,
    'email'    => 'contact@jarnowifi.net',
    'telephone' => '+49 69 1755 491 160',
    'address'  => [
        '@type' => 'PostalAddress',
        'streetAddress'   => 'Penningkruid 71',
        'postalCode'      => '7765 BS',
        'addressLocality' => 'Weiteveen',
        'addressCountry'  => 'NL',
    ],
    'areaServed' => [
        ['@type' => 'Country', 'name' => 'Netherlands'],
        ['@type' => 'Country', 'name' => 'Belgium'],
        ['@type' => 'Country', 'name' => 'Luxembourg'],
        ['@type' => 'Country', 'name' => 'Germany'],
    ],
    'founder' => [
        ['@type' => 'Person', 'name' => 'Jarno Sulmann'],
        ['@type' => 'Person', 'name' => 'Joshua Treudler'],
    ],
], $jsonLd ?? []), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<?php if (analyticsConsented()): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-D6BR389F7B"></script>
<script src="/js/analytics.js" defer></script>
<?php endif; ?>
