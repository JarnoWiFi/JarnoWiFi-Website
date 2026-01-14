<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<!-- Language detection via cookie and localStorage -->
<script>
  (function() {
    // Get language: from cookie, then localStorage, then browser, then default
    function getLanguage() {
      // Check cookie first
      const cookies = document.cookie.split(';');
      for (let cookie of cookies) {
        const [name, value] = cookie.trim().split('=');
        if (name === 'preferredLanguage') {
          return decodeURIComponent(value);
        }
      }
      
      // Check localStorage
      const stored = localStorage.getItem('preferredLanguage');
      if (stored) return stored;
      
      // Check browser language
      const browserLang = navigator.language.toLowerCase().split('-')[0];
      if (['nl', 'en', 'de'].includes(browserLang)) {
        return browserLang;
      }
      
      return 'nl';
    }

    const path = window.location.pathname;
    const pathMatch = path.match(/^\/(en|de|nl)(\/|$)/);
    const currentLang = pathMatch ? pathMatch[1] : null;
    
    // If already on a language path, save it and continue
    if (currentLang) {
      localStorage.setItem('preferredLanguage', currentLang);
      document.cookie = `preferredLanguage=${currentLang};path=/;max-age=31536000;SameSite=Lax`;
    } else {
      // Not on language path - detect preferred language and redirect
      const detectedLang = getLanguage();
      
      // Save the preference
      localStorage.setItem('preferredLanguage', detectedLang);
      document.cookie = `preferredLanguage=${detectedLang};path=/;max-age=31536000;SameSite=Lax`;
      
      if (path === '/') {
        // Root path - go to language-prefixed home
        window.location.pathname = '/' + detectedLang + '/';
      } else {
        // Non-language-prefixed page like /jobs - add language prefix
        window.location.pathname = '/' + detectedLang + path;
      }
    }
  })();
</script>

<!-- SEO Meta Tags -->
<meta name="description" content="JarnoWiFi levert professionele wifi voor markten, kampen en festivals met Starlink en 5G-back-up." />
<?php
  $path = $_SERVER['REQUEST_URI'];
  $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
  
  // Extract current page without language prefix
  $page = preg_replace('#^/[a-z]{2}(/|$)#', '/', $path);
  $page = $page === '/' ? '/' : rtrim($page, '/');
?>
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
