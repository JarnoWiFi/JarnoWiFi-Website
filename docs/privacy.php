<?php
require __DIR__ . '/partials/i18n-boot.php';

$metaTitle          = t('privacy.title') . ' — JarnoWiFi';
$metaDescriptionKey = 'privacy.intro';
$metaImage          = '/img/opt/og-default.png';
$activeNav          = 'privacy';

$sections = ['controller', 'form', 'cookies', 'analytics', 'hosting', 'rights'];
?>
<!doctype html>
<html lang="<?= e($currentLang) ?>">
  <head>
    <?php include __DIR__ . '/partials/meta-common.php'; ?>
    <meta name="robots" content="noindex, follow" />
  </head>
  <body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <main id="main" class="page-shell">
      <section class="container mb-5">
        <div class="hero-video">
          <div class="hero-video__overlay"></div>
          <div class="container hero-video__content">
            <div class="row justify-content-center mx-0">
              <div class="col-lg-8">
                <p class="section-label mb-2"><?= te('privacy.label') ?></p>
                <h1 class="fw-bold mb-0"><span class="text-gradient"><?= te('privacy.title') ?></span></h1>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <p class="lead text-muted mb-4"><?= te('privacy.intro') ?></p>

            <?php foreach ($sections as $section): ?>
            <section class="card info-card p-4 mb-4">
              <h2 class="h5 fw-semibold"><?= te("privacy.{$section}.title") ?></h2>
              <p class="text-muted mb-0"><?= te("privacy.{$section}.body") ?></p>
            </section>
            <?php endforeach; ?>

            <section class="card info-card p-4 mb-4">
              <h2 class="h5 fw-semibold"><?= te('consent.title') ?></h2>
              <p class="text-muted"><?= te('consent.body') ?></p>
              <p class="mb-0">
                <button type="button" class="btn btn-sm btn-outline-dark" data-consent-withdraw>
                  <?= te('privacy.withdraw') ?>
                </button>
              </p>
            </section>

            <p class="text-muted small"><?= te('privacy.updated') ?></p>
          </div>
        </div>
      </div>
    </main>

    <?php
      include __DIR__ . '/partials/footer.php';
      include __DIR__ . '/partials/consent.php';
      include __DIR__ . '/partials/scripts.php';
    ?>
  </body>
</html>
