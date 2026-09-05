<?php
require __DIR__ . '/partials/i18n-boot.php';

$metaTitle       = t('impressum.title') . ' — JarnoWiFi';
$metaDescription = t('impressum.title') . ' — JarnoWiFi';
$metaImage       = '/img/opt/og-default.png';
$activeNav       = 'imprint';
?>
<!doctype html>
<html lang="<?= e($currentLang) ?>">
  <head>
    <?php include __DIR__ . '/partials/meta-common.php'; ?>
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
                <p class="section-label mb-2"><?= te('impressum.label') ?></p>
                <h1 class="fw-bold mb-0"><span class="text-gradient"><?= te('impressum.title') ?></span></h1>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <section class="card info-card p-4 mb-4">
              <h2 class="h5 fw-semibold"><?= te('impressum.provider.title') ?></h2>
              <div class="text-muted">
                <p class="mb-3"><?= te('impressum.provider.value') ?></p>
                <h3 class="h6 fw-semibold"><?= te('impressum.represented.title') ?></h3>
                <p class="mb-3"><?= te('impressum.represented.value') ?></p>
                <h3 class="h6 fw-semibold"><?= te('impressum.address.title') ?></h3>
                <address class="mb-0">
                  <?= te('impressum.address.line1') ?><br />
                  <?= te('impressum.address.line2') ?><br />
                  <?= te('impressum.address.line3') ?>
                </address>
              </div>
            </section>

            <section class="card info-card p-4 mb-4">
              <h2 class="h5 fw-semibold"><?= te('impressum.contact.title') ?></h2>
              <dl class="text-muted contact-list mb-0">
                <div class="contact-row">
                  <dt><?= te('impressum.contact.emailLabel') ?></dt>
                  <dd class="mb-0"><a href="mailto:<?= te('impressum.contact.emailValue') ?>"><?= te('impressum.contact.emailValue') ?></a></dd>
                </div>
                <div class="contact-row">
                  <dt><?= te('impressum.contact.nocLabel') ?></dt>
                  <dd class="mb-0"><a href="mailto:<?= te('impressum.contact.nocValue') ?>"><?= te('impressum.contact.nocValue') ?></a></dd>
                </div>
                <div class="contact-row">
                  <dt><?= te('impressum.contact.salesLabel') ?></dt>
                  <dd class="mb-0"><a href="tel:+4969175549160"><?= te('impressum.contact.salesValue') ?></a></dd>
                </div>
                <div class="contact-row">
                  <dt><?= te('impressum.contact.incidentsLabel') ?></dt>
                  <dd class="mb-0"><a href="tel:+4969175549161"><?= te('impressum.contact.incidentsValue') ?></a></dd>
                </div>
                <div class="contact-row">
                  <dt><?= te('impressum.contact.webLabel') ?></dt>
                  <dd class="mb-0"><?= te('impressum.contact.webValue') ?></dd>
                </div>
              </dl>
            </section>

            <section class="card info-card p-4 mb-4">
              <h2 class="h5 fw-semibold"><?= te('impressum.responsible.title') ?></h2>
              <p class="text-muted mb-0"><?= te('impressum.responsible.value') ?></p>
            </section>

            <section class="card info-card p-4 mb-4">
              <h2 class="h5 fw-semibold"><?= te('impressum.register.title') ?></h2>
              <p class="text-muted mb-0"><?= te('impressum.register.value') ?></p>
            </section>

            <section class="card info-card p-4">
              <h2 class="h5 fw-semibold"><?= te('impressum.vat.title') ?></h2>
              <p class="text-muted mb-0"><?= te('impressum.vat.value') ?></p>
            </section>
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
