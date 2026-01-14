<?php
// Detect language from URL path for server-side rendering
$path = $_SERVER['REQUEST_URI'];
preg_match('#^/([a-z]{2})(?:/|$)#', $path, $matches);
$currentLang = isset($matches[1]) && in_array($matches[1], ['nl', 'en', 'de']) ? $matches[1] : 'nl';

// Load translations for server-side rendering
$translationsFile = __DIR__ . '/../locales/translations.json';
$translations = [];
if (file_exists($translationsFile)) {
  $translationsData = json_decode(file_get_contents($translationsFile), true);
  $translations = $translationsData[$currentLang] ?? [];
}

// Helper function to get translation
function t($key, $fallback = '') {
  global $translations;
  if (isset($translations[$key])) {
    return $translations[$key];
  }
  // Handle nested keys like meta.title
  $keys = explode('.', $key);
  $value = $translations;
  foreach ($keys as $k) {
    if (isset($value[$k])) {
      $value = $value[$k];
    } else {
      return $fallback ?: $key;
    }
  }
  return is_string($value) ? $value : ($fallback ?: $key);
}
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<!-- Set language in localStorage on page load -->
<script>
  localStorage.setItem('preferredLanguage', '<?= $currentLang ?>');
  document.cookie = 'preferredLanguage=<?= $currentLang ?>;path=/;max-age=31536000;SameSite=Lax';
</script>

<!-- SEO Meta Tags -->
<?php
  $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

  // Extract current page without language prefix
  $page = preg_replace('#^/[a-z]{2}(/|$)#', '/', $path);
  $page = $page === '/' ? '/' : rtrim($page, '/');

  // Compute per-page meta values with safe fallbacks
  $computedTitle = isset($metaTitle) && is_string($metaTitle) && $metaTitle !== ''
    ? $metaTitle
    : t('meta.title', 'JarnoWiFi — Enterprise Event WiFi Anywhere');

  // Allow pages to provide a translation key for description
  if (isset($metaDescriptionKey) && is_string($metaDescriptionKey) && $metaDescriptionKey !== '') {
    $computedDescription = t($metaDescriptionKey, t('meta.description', 'JarnoWiFi delivers professional WiFi for markets, camps, and festivals with Starlink and 5G backup.'));
  } else {
    $computedDescription = isset($metaDescription) && is_string($metaDescription) && $metaDescription !== ''
      ? $metaDescription
      : t('meta.description', 'JarnoWiFi delivers professional WiFi for markets, camps, and festivals with Starlink and 5G backup.');
  }

  $computedUrl = isset($metaUrl) && is_string($metaUrl) && $metaUrl !== ''
    ? $metaUrl
    : $baseUrl . $_SERVER['REQUEST_URI'];

  $rawImage = isset($metaImage) && is_string($metaImage) && $metaImage !== ''
    ? $metaImage
    : '/img/people/jarno.jpeg';
  $computedImage = (strpos($rawImage, 'http://') === 0 || strpos($rawImage, 'https://') === 0)
    ? $rawImage
    : $baseUrl . $rawImage;

  // Map locale for OpenGraph
  $ogLocaleMap = [
    'nl' => 'nl_NL',
    'en' => 'en_US',
    'de' => 'de_DE'
  ];
  $ogLocale = $ogLocaleMap[$currentLang] ?? 'nl_NL';
?>
<meta name="description" content="<?= htmlspecialchars($computedDescription) ?>" />
<link rel="canonical" href="<?= htmlspecialchars($computedUrl) ?>" />

<!-- Open Graph -->
<meta property="og:type" content="website" />
<meta property="og:title" content="<?= htmlspecialchars($computedTitle) ?>" />
<meta property="og:description" content="<?= htmlspecialchars($computedDescription) ?>" />
<meta property="og:url" content="<?= htmlspecialchars($computedUrl) ?>" />
<meta property="og:image" content="<?= htmlspecialchars($computedImage) ?>" />
<meta property="og:locale" content="<?= htmlspecialchars($ogLocale) ?>" />

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?= htmlspecialchars($computedTitle) ?>" />
<meta name="twitter:description" content="<?= htmlspecialchars($computedDescription) ?>" />
<meta name="twitter:image" content="<?= htmlspecialchars($computedImage) ?>" />
<link rel="alternate" hreflang="nl" href="<?= $baseUrl ?>/nl<?= $page ?>" />
<link rel="alternate" hreflang="en" href="<?= $baseUrl ?>/en<?= $page ?>" />
<link rel="alternate" hreflang="de" href="<?= $baseUrl ?>/de<?= $page ?>" />
<link rel="alternate" hreflang="x-default" href="<?= $baseUrl ?>/nl<?= $page ?>" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Work+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

<!-- Site CSS -->
<link href="/site.css" rel="stylesheet" />

<!-- Menu Script -->
<script src="/menu.js"></script>

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-D6BR389F7B"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-D6BR389F7B');
</script>
