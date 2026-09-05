<?php
require __DIR__ . '/partials/i18n-boot.php';

$metaTitle          = t('jobs.title') . ' — JarnoWiFi';
$metaDescriptionKey = 'jobs.lead';
$metaImage          = '/img/opt/og-default.png';
$activeNav          = 'jobs';

$roles = [
    ['id' => 'head-of-sales',  'key' => 'hos',   'featured' => true,  'subject' => 'Head of Sales',            'reqs' => 5],
    ['id' => 'field-engineer', 'key' => 'field', 'featured' => false, 'subject' => 'Freelance Field Engineer', 'reqs' => 4],
    ['id' => 'sales',          'key' => 'sales', 'featured' => false, 'subject' => 'Sales / Account',          'reqs' => 5],
];

$jsonLd = ['@graph' => array_map(fn($r) => [
    '@type'          => 'JobPosting',
    'title'          => t("jobs.{$r['key']}.title"),
    'description'    => t("jobs.{$r['key']}.summary"),
    'employmentType' => 'CONTRACTOR',
    'hiringOrganization' => ['@id' => siteOrigin() . '/#business'],
    'jobLocationType' => 'TELECOMMUTE',
    'applicantLocationRequirements' => [
        ['@type' => 'Country', 'name' => 'NL'],
        ['@type' => 'Country', 'name' => 'DE'],
        ['@type' => 'Country', 'name' => 'BE'],
    ],
    'directApply' => true,
], $roles)];
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
              <div class="col-lg-9">
                <p class="section-label mb-2"><?= te('jobs.label') ?></p>
                <h1 class="fw-bold mb-3"><span class="text-gradient"><?= te('jobs.title') ?></span></h1>
                <p class="lead text-white-50 mb-0"><?= te('jobs.lead') ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <section class="card info-card p-4 mb-4">
              <h2 class="h5 fw-semibold"><?= te('jobs.overview.title') ?></h2>
              <p class="text-muted mb-3"><?= te('jobs.overview.body') ?></p>
              <h3 class="h6 fw-semibold"><?= te('jobs.benefits.title') ?></h3>
              <ul class="text-muted mb-3">
                <?php foreach (['b1', 'b2', 'b3', 'b4'] as $b): ?>
                <li><?= te("jobs.benefits.{$b}") ?></li>
                <?php endforeach; ?>
              </ul>
              <ul class="d-flex flex-wrap gap-2 list-unstyled mb-0">
                <?php foreach (['pill1', 'pill2', 'pill3', 'pill4'] as $pill): ?>
                <li class="pill"><?= te("jobs.{$pill}") ?></li>
                <?php endforeach; ?>
              </ul>
            </section>

            <?php foreach ($roles as $role): $k = $role['key']; ?>
            <section class="card job-card p-4 mb-4<?= $role['featured'] ? ' featured' : '' ?>" id="<?= e($role['id']) ?>">
              <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                <div>
                  <h2 class="h4 fw-bold mb-1"><?= te("jobs.{$k}.title") ?></h2>
                  <p class="text-muted mb-0"><?= te("jobs.{$k}.meta") ?></p>
                </div>
                <a class="btn btn-sm cta-primary"
                   href="mailto:jobs@jarnowifi.net?subject=<?= rawurlencode('Application: ' . $role['subject']) ?>">
                  <?= te('jobs.apply') ?>
                </a>
              </div>
              <hr />
              <p class="text-muted"><?= te("jobs.{$k}.summary") ?></p>
              <div class="row g-4">
                <div class="col-md-6">
                  <h3 class="h6 fw-semibold"><?= te('jobs.responsibilities') ?></h3>
                  <ul class="text-muted mb-0">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                    <li><?= te("jobs.{$k}.r{$i}") ?></li>
                    <?php endfor; ?>
                  </ul>
                </div>
                <div class="col-md-6">
                  <h3 class="h6 fw-semibold"><?= te('jobs.requirements') ?></h3>
                  <ul class="text-muted mb-0">
                    <?php for ($i = 1; $i <= $role['reqs']; $i++): ?>
                    <li><?= te("jobs.{$k}.req{$i}") ?></li>
                    <?php endfor; ?>
                  </ul>
                </div>
              </div>
            </section>
            <?php endforeach; ?>

            <section class="card info-card p-4">
              <h2 class="h5 fw-semibold"><?= te('jobs.howto.title') ?></h2>
              <p class="text-muted mb-2"><?= te('jobs.howto.body1') ?></p>
              <p class="text-muted mb-0"><?= te('jobs.howto.body2') ?></p>
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
