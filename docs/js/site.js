/**
 * Site behaviour: image lightbox, contact form, cookie consent.
 *
 * Copy is rendered server-side, so there is no client-side translation here.
 * The few strings JS needs are passed in via data-* attributes.
 */

/* ---------------------------------------------------------------- lightbox */
function setupLightbox() {
  const modalEl = document.getElementById('imageModal');
  if (!modalEl || !window.bootstrap) return;

  const modal = new bootstrap.Modal(modalEl);
  const image = modalEl.querySelector('[data-modal-image]');
  const label = modalEl.querySelector('#imageModalLabel');

  document.querySelectorAll('[data-enlarge]').forEach((trigger) => {
    trigger.addEventListener('click', () => {
      const img = trigger.querySelector('img') || trigger;
      image.src = img.currentSrc || img.src;
      image.alt = img.alt || '';
      if (label) label.textContent = img.alt || '';
      modal.show();
    });
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
  setupLightbox();
  setupContactForm();
  setupConsent();
  setupHeroVideo();
});
