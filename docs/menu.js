import { i18n } from '/js/i18n.js';

function setActiveNav(placeholder, activeKey) {
  if (!placeholder || !activeKey) {
    return;
  }
  const activeLink = placeholder.querySelector(`[data-nav-key="${activeKey}"]`);
  if (activeLink) {
    activeLink.classList.add("active");
    activeLink.setAttribute("aria-current", "page");
  }
}

function setCurrentLanguage(placeholder) {
  if (!placeholder) return;

  const langMap = {
    nl: { flag: "🇳🇱", code: "NL" },
    en: { flag: "🇬🇧", code: "EN" },
    de: { flag: "🇩🇪", code: "DE" }
  };

  // Use i18n's language, not just URL
  const currentLang = i18n.getCurrentLanguage();
  const langData = langMap[currentLang] || langMap.nl;

  const flagElement = document.querySelector("#currentFlag");
  const langElement = document.querySelector("#currentLang");
  const langDropdown = document.querySelector('#languageDropdown');
  const langLinks = document.querySelectorAll('[data-lang]');

  // Update the dropdown to reflect the current language
  if (langDropdown) {
    langDropdown.value = currentLang;
    
    // Only add event listener if not already attached
    if (!langDropdown.dataset.listenerAttached) {
      langDropdown.addEventListener('change', function(e) {
        const selectedLang = this.value;
        // Save language preference to both localStorage and cookie
        localStorage.setItem('preferredLanguage', selectedLang);
        document.cookie = `preferredLanguage=${selectedLang};path=/;max-age=31536000;SameSite=Lax`;
        // Get current path and replace language prefix
        let path = window.location.pathname;
        path = path.replace(/^\/[a-z]{2}(?:\/|$)/, '/');
        // Navigate to same page in selected language
        window.location.pathname = `/${selectedLang}${path === '/' ? '/' : path}`;
      });
      langDropdown.dataset.listenerAttached = 'true';
    }
  }

  // Update language dropdown links to preserve current path with language prefix
  langLinks.forEach(link => {
    const lang = link.getAttribute('data-lang');
    const path = window.location.pathname;
    
    // Remove existing language prefix if present
    let newPath = path.replace(/^\/[a-z]{2}(?:\/|$)/, '/');
    if (newPath === path) {
      newPath = path === '/' ? '/' : path;
    }
    
    // Add new language prefix
    const finalPath = `/${lang}${newPath === '/' ? '/' : newPath}`;
    link.href = finalPath;
  });

  // Update flag and language text display
  if (flagElement) {
    flagElement.textContent = langData.flag;
    flagElement.innerHTML = langData.flag;
  }
  if (langElement) {
    langElement.textContent = langData.code;
  }

  console.log("[menu.js] Setting language display:", currentLang, "Flag:", langData.flag, "Code:", langData.code);
}

async function loadHeader(options = {}) {
  const placeholder = document.querySelector('[data-include="header"]');
  if (!placeholder) {
    return Promise.resolve(null);
  }

  const activeKey = options.active || placeholder.dataset.active || "";

  try {
    // Ensure i18n is initialized
    if (!i18n.translations) {
      console.log('[menu.js] Initializing i18n...');
      await i18n.init();
    }
    
    const currentLang = i18n.getCurrentLanguage();
    console.log('[menu.js] Current language:', currentLang);

    const response = await fetch("/partials/header.html", { cache: "no-store" });
    if (!response.ok) {
      throw new Error(`Header request failed with status ${response.status}`);
    }
    
    const html = await response.text();
    placeholder.innerHTML = html;
    setActiveNav(placeholder, activeKey);
    setCurrentLanguage(placeholder);
    
    // Apply translations to all data-i18n elements in header
    const elements = placeholder.querySelectorAll('[data-i18n]');
    console.log('[menu.js] Found', elements.length, 'elements to translate in header');
    elements.forEach((el) => {
      const key = el.getAttribute('data-i18n');
      const translation = i18n.t(key, currentLang);
      if (translation && translation !== key) {
        el.textContent = translation;
        console.log('[menu.js] Translated:', key, '=>', translation);
      } else {
        console.warn('[menu.js] Missing translation for:', key, 'in language:', currentLang);
      }
    });
    
    // Update internal navigation links to include language prefix
    const navLinks = placeholder.querySelectorAll('a[href^="/"]');
    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      // Skip language dropdown links
      if (href.includes('?lang=') || link.hasAttribute('data-lang')) {
        return;
      }
      // Add language prefix if not already there
      if (!href.match(/^\/(en|de|nl)(\/|#|$)/)) {
        const newHref = href === '/' ? `/${currentLang}/` : `/${currentLang}${href}`;
        link.href = newHref;
        console.log('[menu.js] Updated link:', href, '=>', newHref);
      }
    });
    
    document.dispatchEvent(new CustomEvent("header:loaded", { detail: { active: activeKey } }));
    return placeholder;
  } catch (error) {
    console.error("[menu.js] Unable to load header:", error);
    return null;
  }
}

async function loadFooter() {
  const placeholder = document.querySelector('[data-include="footer"]');
  if (!placeholder) {
    return Promise.resolve(null);
  }

  try {
    // Ensure i18n is initialized
    if (!i18n.translations) {
      console.log('[menu.js] Initializing i18n for footer...');
      await i18n.init();
    }
    
    const currentLang = i18n.getCurrentLanguage();
    console.log('[menu.js] Translating footer with language:', currentLang);

    const response = await fetch("/partials/footer.php");
    if (!response.ok) {
      throw new Error(`Footer request failed with status ${response.status}`);
    }
    
    const html = await response.text();
    placeholder.innerHTML = html;
    
    // Apply translations to all data-i18n elements in footer
    const elements = placeholder.querySelectorAll('[data-i18n]');
    console.log('[menu.js] Found', elements.length, 'elements to translate in footer');
    elements.forEach((el) => {
      const key = el.getAttribute('data-i18n');
      const translation = i18n.t(key, currentLang);
      if (translation && translation !== key) {
        el.textContent = translation;
        console.log('[menu.js] Translated footer:', key, '=>', translation);
      } else {
        console.warn('[menu.js] Missing footer translation for:', key);
      }
    });
    
    // Update internal navigation links in footer to include language prefix
    const footerLinks = placeholder.querySelectorAll('a[href^="/"]');
    footerLinks.forEach(link => {
      const href = link.getAttribute('href');
      // Skip hash links
      if (href.startsWith('/#')) {
        return;
      }
      // Add language prefix if not already there
      if (!href.match(/^\/(en|de|nl)(\/|#|$)/)) {
        const newHref = href === '/' ? `/${currentLang}/` : `/${currentLang}${href}`;
        link.href = newHref;
        console.log('[menu.js] Updated footer link:', href, '=>', newHref);
      }
    });
    
    return placeholder;
  } catch (error) {
    console.error("[menu.js] Unable to load footer:", error);
    return null;
  }
}

window.loadHeader = loadHeader;
window.loadFooter = loadFooter;
