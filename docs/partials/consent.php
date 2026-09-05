<?php if (!isset($_COOKIE['analyticsConsent'])): ?>
<div class="consent-banner" data-consent-banner hidden role="region" aria-label="<?= te('consent.title') ?>">
  <div class="container d-flex flex-column flex-lg-row align-items-lg-center gap-3">
    <p class="mb-0 small flex-grow-1"><?= te('consent.body') ?></p>
    <div class="d-flex flex-wrap gap-2">
      <a class="btn btn-sm btn-link text-white" href="<?= e(langUrl('/privacy')) ?>"><?= te('consent.more') ?></a>
      <button type="button" class="btn btn-sm btn-outline-light" data-consent-decline><?= te('consent.decline') ?></button>
      <button type="button" class="btn btn-sm cta-primary" data-consent-accept><?= te('consent.accept') ?></button>
    </div>
  </div>
</div>
<?php endif; ?>
