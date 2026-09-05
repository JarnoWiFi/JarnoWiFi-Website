<?php declare(strict_types=1); $home = langUrl('/'); ?>
<footer class="footer py-4">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h2 class="h5 fw-semibold">JarnoWiFi</h2>
        <p class="text-white-50 mb-0"><?= te('footer.tagline') ?></p>
      </div>
      <div class="col-md-6 mt-3 mt-md-0">
        <nav class="text-md-end" aria-label="<?= te('a11y.footerNav') ?>">
          <a class="me-3" href="<?= e($home) ?>#services"><?= te('footer.services') ?></a>
          <a class="me-3" href="<?= e(langUrl('/reliability')) ?>"><?= te('footer.reliability') ?></a>
          <a class="me-3" href="<?= e($home) ?>#video-surveillance"><?= te('footer.video') ?></a>
          <a class="me-3" href="<?= e($home) ?>#pricing"><?= te('footer.plans') ?></a>
          <a class="me-3" href="<?= e(langUrl('/jobs')) ?>"><?= te('footer.jobs') ?></a>
          <a class="me-3" href="<?= e(langUrl('/privacy')) ?>"><?= te('footer.privacy') ?></a>
          <a class="me-3" href="<?= e(langUrl('/imprint')) ?>"><?= te('footer.impressum') ?></a>
          <a href="<?= e($home) ?>#contact"><?= te('footer.contact') ?></a>
        </nav>
      </div>
    </div>
    <p class="text-white-50 small mb-0 mt-4">
      &copy; <?= date('Y') ?> Jarno Sulmann &mdash; JarnoWiFi. <?= te('footer.copyright') ?>
    </p>
  </div>
</footer>
