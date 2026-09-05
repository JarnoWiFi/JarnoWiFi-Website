/**
 * Site behaviour: navigation, lightbox, contact form, cookie consent.
 *
 * Copy is rendered server-side, so there is no client-side translation here.
 * The few strings JS needs are passed in via data-* attributes.
 *
 * There is no UI framework. The handful of interactive widgets (nav collapse,
 * language dropdown, FAQ accordion, lightbox) are implemented below against the
 * same data-bs-* hooks the markup already used, so the templates did not change.
 */

/* -------------------------------------------------------------- primitives */

const isOpen = (el) => el.classList.contains('show');

function setExpanded(trigger, open) {
  if (trigger) trigger.setAttribute('aria-expanded', String(open));
}

/* --------------------------------------------------------- nav / accordion */

/**
 * data-bs-toggle="collapse" shows or hides data-bs-target. When the target
 * declares data-bs-parent (the FAQ), its siblings close first.
 */
function setupCollapse() {
  document.querySelectorAll('[data-bs-toggle="collapse"]').forEach((trigger) => {
    const selector = trigger.getAttribute('data-bs-target');
    const target = selector && document.querySelector(selector);
    if (!target) return;

    setExpanded(trigger, isOpen(target));
    trigger.classList.toggle('collapsed', !isOpen(target));

    trigger.addEventListener('click', (event) => {
      event.preventDefault();
      const opening = !isOpen(target);

      const parentSelector = target.getAttribute('data-bs-parent');
      if (opening && parentSelector) {
        const parent = document.querySelector(parentSelector);
        parent?.querySelectorAll('.accordion-collapse.show').forEach((sibling) => {
          if (sibling === target) return;
          sibling.classList.remove('show');
          const owner = document.querySelector(`[data-bs-target="#${sibling.id}"]`);
          setExpanded(owner, false);
          owner?.classList.add('collapsed');
        });
      }

      target.classList.toggle('show', opening);
      setExpanded(trigger, opening);
      trigger.classList.toggle('collapsed', !opening);

      if (target.classList.contains('navbar-collapse')) {
        document.querySelector('.navbar')?.classList.toggle('nav-open', opening);
      }
    });
  });

  // Following an in-page link should close the mobile menu behind it.
  document.querySelector('.navbar-collapse')?.addEventListener('click', (event) => {
    if (!event.target.closest('a')) return;
    const panel = document.querySelector('.navbar-collapse');
    panel?.classList.remove('show');
    document.querySelector('.navbar')?.classList.remove('nav-open');
    const toggler = document.querySelector('[data-bs-target="#mainNavbar"]');
    setExpanded(toggler, false);
    toggler?.classList.add('collapsed');
  });
}

/* ---------------------------------------------------------------- dropdown */

function setupDropdown() {
  const toggles = document.querySelectorAll('[data-bs-toggle="dropdown"]');
  if (!toggles.length) return;

  const closeAll = (except) => {
    document.querySelectorAll('.dropdown-menu.show').forEach((menu) => {
      if (menu === except) return;
      menu.classList.remove('show');
      setExpanded(menu.parentElement?.querySelector('[data-bs-toggle="dropdown"]'), false);
    });
  };

  toggles.forEach((toggle) => {
    const menu = toggle.parentElement?.querySelector('.dropdown-menu');
    if (!menu) return;

    toggle.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      const opening = !isOpen(menu);
      closeAll(menu);
      menu.classList.toggle('show', opening);
      setExpanded(toggle, opening);
    });
  });

  document.addEventListener('click', () => closeAll());
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') closeAll();
  });
}

/* ------------------------------------------------------- navbar elevation */

/** Solid background once the page scrolls off the (dark) hero. */
function setupNavbarScroll() {
  const navbar = document.querySelector('.navbar');
  if (!navbar) return;

  const sentinel = document.createElement('div');
  sentinel.setAttribute('aria-hidden', 'true');
  sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;';
  document.body.prepend(sentinel);

  new IntersectionObserver(
    ([entry]) => navbar.classList.toggle('is-stuck', !entry.isIntersecting),
    { threshold: 0 }
  ).observe(sentinel);

  // On overlay pages the bar keeps its dark treatment for as long as the dark
  // hero is behind it; only past the hero does it adopt the page background.
  const hero = navbar.classList.contains('navbar--overlay')
    ? document.querySelector('.hero')
    : null;
  if (!hero) return;

  new IntersectionObserver(
    ([entry]) => navbar.classList.toggle('is-past-hero', !entry.isIntersecting),
    { rootMargin: `-${navbar.offsetHeight || 68}px 0px 0px 0px`, threshold: 0 }
  ).observe(hero);
}

/* ---------------------------------------------------------------- lightbox */

function setupLightbox() {
  const modalEl = document.getElementById('imageModal');
  if (!modalEl) return;

  const image = modalEl.querySelector('[data-modal-image]');
  const label = modalEl.querySelector('#imageModalLabel');
  let lastFocused = null;

  function show() {
    lastFocused = document.activeElement;
    modalEl.classList.add('show');
    modalEl.removeAttribute('aria-hidden');
    document.body.style.overflow = 'hidden';
    requestAnimationFrame(() => modalEl.classList.add('in'));
    modalEl.querySelector('[data-bs-dismiss="modal"]')?.focus();
  }

  function hide() {
    modalEl.classList.remove('in', 'show');
    modalEl.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    image.removeAttribute('src');
    lastFocused?.focus();
  }

  document.querySelectorAll('[data-enlarge]').forEach((trigger) => {
    trigger.addEventListener('click', () => {
      const img = trigger.querySelector('img') || trigger;
      image.src = img.currentSrc || img.src;
      image.alt = img.alt || '';
      if (label) label.textContent = img.alt || '';
      show();
    });
  });

  modalEl.querySelector('[data-bs-dismiss="modal"]')?.addEventListener('click', hide);

  // Clicking the backdrop (anything outside the image) closes it.
  modalEl.addEventListener('click', (event) => {
    if (!event.target.closest('.modal-body, .modal-header')) hide();
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && modalEl.classList.contains('show')) hide();
  });
}

/* ------------------------------------------------------------ contact form */
function setupContactForm() {
  const form = document.querySelector('[data-contact-form]');
  if (!form) return;

  const status = document.querySelector('[data-contact-status]');
  const submit = form.querySelector('button[type="submit"]');
  const messages = {
    sending: form.dataset.msgSending,
    success: form.dataset.msgSuccess,
    error: form.dataset.msgError,
  };

  function setStatus(text, variant) {
    if (!status) return;
    status.textContent = text;
    status.className = 'alert mb-0 alert-' + variant;
  }

  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (submit) submit.disabled = true;
    setStatus(messages.sending, 'info');

    try {
      const response = await fetch(form.action, {
        method: 'POST',
        headers: { Accept: 'application/json', 'X-Requested-With': 'fetch' },
        body: new FormData(form),
      });
      const data = await response.json().catch(() => null);

      if (!response.ok || !data || !data.ok) {
        setStatus(messages.error, 'danger');
        return;
      }
      setStatus(messages.success, 'success');
      form.reset();
    } catch (error) {
      setStatus(messages.error, 'danger');
    } finally {
      if (submit) submit.disabled = false;
    }
  });
}

/* -------------------------------------------------------------- hero video */
/**
 * The background video is decorative and ~1.8 MB. The poster image is always
 * shown; the video only loads on wide screens, when the connection looks fast
 * and the visitor has not asked for reduced motion. Note that hiding it in CSS
 * would not have prevented the download.
 */
function setupHeroVideo() {
  const video = document.querySelector('[data-hero-video]');
  if (!video) return;

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const wideEnough = window.matchMedia('(min-width: 992px)').matches;
  const connection = navigator.connection || {};
  const slowConnection =
    connection.saveData === true || /2g/.test(connection.effectiveType || '');

  if (reducedMotion || !wideEnough || slowConnection) return;

  video.hidden = false;
  video.preload = 'auto';
  video.load();
  video.play().catch(() => {
    // Autoplay refused (e.g. power saving) — the poster stays visible.
    video.hidden = true;
  });
}

/* ---------------------------------------------------------------- consent */
const CONSENT_COOKIE = 'analyticsConsent';

function writeConsent(value) {
  document.cookie =
    `${CONSENT_COOKIE}=${value};path=/;max-age=${60 * 60 * 24 * 180};SameSite=Lax`;
}

function setupConsent() {
  const banner = document.querySelector('[data-consent-banner]');

  // Withdrawal control on the privacy page works regardless of the banner.
  document.querySelectorAll('[data-consent-withdraw]').forEach((button) => {
    button.addEventListener('click', () => {
      writeConsent('denied');
      button.disabled = true;
    });
  });

  if (!banner) return;
  banner.hidden = false;

  banner.querySelector('[data-consent-accept]')?.addEventListener('click', () => {
    writeConsent('granted');
    banner.remove();
    // Reload so the server can emit the analytics tag it withheld.
    window.location.reload();
  });

  banner.querySelector('[data-consent-decline]')?.addEventListener('click', () => {
    writeConsent('denied');
    banner.remove();
  });
}

document.addEventListener('DOMContentLoaded', () => {
  setupCollapse();
  setupDropdown();
  setupNavbarScroll();
  setupLightbox();
  setupContactForm();
  setupConsent();
  setupHeroVideo();
});
