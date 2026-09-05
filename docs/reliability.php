<?php
require __DIR__ . '/partials/i18n-boot.php';

$metaTitle          = t('reliabilityPage.title') . ' — JarnoWiFi';
$metaDescriptionKey = 'reliabilityPage.lead';
$metaImage          = '/img/opt/og-default.png';
$activeNav          = 'reliability';

$metrics = ['sla', 'failover', 'power', 'noc'];
$pillars = ['uplinks', 'power', 'monitoring', 'runbooks'];
$slaRows = ['failover', 'incident', 'field', 'update'];
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
            <div class="row align-items-center mx-0">
              <div class="col-lg-8">
                <p class="section-label mb-2"><?= te('reliabilityPage.label') ?></p>
                <h1 class="fw-bold mb-3"><span class="text-gradient"><?= te('reliabilityPage.title') ?></span></h1>
                <p class="lead text-white-50 mb-4"><?= te('reliabilityPage.lead') ?></p>
                <p class="mb-0">
                  <a class="btn btn-sm cta-primary" href="<?= e(langUrl('/')) ?>#pricing"><?= te('reliabilityPage.ctaSecondary') ?></a>
                </p>
                <ul class="d-flex flex-wrap gap-2 mt-4 list-unstyled mb-0">
                  <li class="metric-pill"><?= te('reliabilityPage.hero.stat1') ?></li>
                  <li class="metric-pill"><?= te('reliabilityPage.hero.stat2') ?></li>
                  <li class="metric-pill"><?= te('reliabilityPage.failover') ?></li>
                  <li class="metric-pill"><?= te('reliabilityPage.power') ?></li>
                  <li class="metric-pill"><?= te('reliabilityPage.noc') ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="container mb-5">
        <h2 class="visually-hidden"><?= te('reliabilityPage.sla.matrixLabel') ?></h2>
        <div class="row g-4">
          <?php foreach ($metrics as $metric): ?>
          <div class="col-md-6 col-lg-3">
            <div class="info-card p-3 h-100">
              <p class="text-muted mb-1"><?= te("reliabilityPage.metrics.{$metric}Label") ?></p>
              <p class="h5 fw-bold mb-2"><?= te("reliabilityPage.metrics.{$metric}Value") ?></p>
              <p class="small text-muted mb-0"><?= te("reliabilityPage.metrics.{$metric}Note") ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>

      <section class="container mb-5">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label"><?= te('reliabilityPage.pillars.label') ?></p>
            <h2 class="fw-bold"><?= te('reliabilityPage.pillars.title') ?></h2>
            <p class="text-muted"><?= te('reliabilityPage.pillars.lead') ?></p>
          </div>
        </div>
        <div class="row g-4">
          <?php foreach ($pillars as $pillar): ?>
          <div class="col-md-6 col-lg-3">
            <div class="pillar-card p-4 h-100">
              <h3 class="h5 fw-semibold"><?= te("reliabilityPage.pillars.{$pillar}.title") ?></h3>
              <ul class="text-muted mb-0 check-list">
                <?php foreach (['item1', 'item2', 'item3'] as $item): ?>
                <li><?= te("reliabilityPage.pillars.{$pillar}.{$item}") ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>

      <section class="container mb-5">
        <div class="row align-items-stretch g-4">
          <div class="col-lg-6">
            <div class="info-card p-4 h-100">
              <p class="section-label mb-2"><?= te('reliabilityPage.sla.label') ?></p>
              <h2 class="h4 fw-bold mb-3"><?= te('reliabilityPage.sla.title') ?></h2>
              <ul class="text-muted mb-0 check-list">
                <?php foreach (['item1', 'item2', 'item3', 'item4'] as $item): ?>
                <li><?= te("reliabilityPage.sla.{$item}") ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-card p-4 h-100">
              <h2 class="section-label mb-2"><?= te('reliabilityPage.sla.matrixLabel') ?></h2>
              <div class="table-responsive">
                <table class="table align-middle mb-0">
                  <thead>
                    <tr>
                      <th scope="col"><?= te('reliabilityPage.sla.table.col1') ?></th>
                      <th scope="col"><?= te('reliabilityPage.sla.table.col2') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($slaRows as $row): ?>
                    <tr>
                      <th scope="row" class="fw-normal"><?= te("reliabilityPage.sla.table.{$row}") ?></th>
                      <td><?= te("reliabilityPage.sla.table.{$row}Value") ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <p class="small text-muted mb-0 mt-3"><?= te('reliabilityPage.sla.footer') ?></p>
            </div>
          </div>
        </div>
      </section>

      <section class="container mb-5">
        <div class="info-card p-4">
          <div class="row g-4 align-items-center">
            <div class="col-lg-6">
              <p class="section-label mb-2"><?= te('reliabilityPage.runbook.label') ?></p>
              <h2 class="h4 fw-bold mb-3"><?= te('reliabilityPage.runbook.title') ?></h2>
              <ol class="text-muted mb-0">
                <?php foreach (['step1', 'step2', 'step3', 'step4', 'step5'] as $step): ?>
                <li><?= te("reliabilityPage.runbook.{$step}") ?></li>
                <?php endforeach; ?>
              </ol>
            </div>
            <div class="col-lg-6">
              <div class="cta-band cta-band--dark h-100">
                <h2 class="h4 fw-semibold"><?= te('reliabilityPage.ctaBand.title') ?></h2>
                <p class="mb-4"><?= te('reliabilityPage.ctaBand.lead') ?></p>
                <div class="d-flex flex-wrap gap-3">
                  <a class="btn btn-sm cta-primary" href="<?= e(langUrl('/')) ?>#contact"><?= te('reliabilityPage.ctaBand.primary') ?></a>
                  <a class="btn btn-sm cta-outline" href="mailto:noc@jarnowifi.net"><?= te('reliabilityPage.ctaBand.secondary') ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <?php
      include __DIR__ . '/partials/footer.php';
      include __DIR__ . '/partials/consent.php';
      include __DIR__ . '/partials/scripts.php';
    ?>
  </body>
</html>
