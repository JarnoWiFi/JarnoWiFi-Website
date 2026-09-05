<?php
/** Site header. Rendered server-side so it works without JS and is crawlable. */
declare(strict_types=1);

$activeNav = $activeNav ?? '';
$home = langUrl('/');

$navItems = [
    ['key' => 'services',    'href' => $home . '#services',           'label' => 'nav.services'],
    ['key' => 'reliability', 'href' => langUrl('/reliability'),       'label' => 'nav.reliability'],
    ['key' => 'useCases',    'href' => $home . '#use-cases',          'label' => 'nav.useCases'],
    ['key' => 'video',       'href' => $home . '#video-surveillance', 'label' => 'nav.video'],
    ['key' => 'plans',       'href' => $home . '#pricing',            'label' => 'nav.plans'],
    ['key' => 'blog',        'href' => langUrl('/blog'),              'label' => 'nav.blog'],
    ['key' => 'jobs',        'href' => langUrl('/jobs'),              'label' => 'nav.jobs'],
    ['key' => 'faq',         'href' => $home . '#faq',                'label' => 'nav.faq'],
];

$langNames = ['nl' => 'Nederlands', 'en' => 'English', 'de' => 'Deutsch'];
$langFlags = ['nl' => '🇳🇱', 'en' => '🇬🇧', 'de' => '🇩🇪'];
?>
<a class="skip-link" href="#main"><?= te('a11y.skipToContent') ?></a>
<nav class="navbar navbar-expand-lg fixed-top" aria-label="<?= te('a11y.mainNav') ?>">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= e($home) ?>">JarnoWiFi</a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#mainNavbar"
      aria-controls="mainNavbar"
      aria-expanded="false"
      aria-label="<?= te('a11y.mainNav') ?>"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php foreach ($navItems as $item): ?>
        <li class="nav-item">
          <a class="nav-link<?= $activeNav === $item['key'] ? ' active' : '' ?>"
             href="<?= e($item['href']) ?>"
             <?= $activeNav === $item['key'] ? 'aria-current="page"' : '' ?>><?= te($item['label']) ?></a>
        </li>
        <?php endforeach; ?>
      </ul>
      <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-2 ms-lg-3 mt-3 mt-lg-0">
        <a class="btn btn-sm btn-dark" href="<?= e($home) ?>#contact"><?= te('nav.cta') ?></a>
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-dark dropdown-toggle d-flex align-items-center gap-2"
                  type="button" id="languageDropdown" data-bs-toggle="dropdown"
                  aria-expanded="false" aria-label="<?= te('a11y.chooseLanguage') ?>">
            <span class="flag-icon" aria-hidden="true"><?= $langFlags[$currentLang] ?></span>
            <span><?= e(strtoupper($currentLang)) ?></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
            <?php foreach (SUPPORTED_LANGS as $lang): ?>
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2"
                 href="<?= e(langUrl($pagePath, $lang)) ?>"
                 hreflang="<?= e($lang) ?>" lang="<?= e($lang) ?>"
                 <?= $lang === $currentLang ? 'aria-current="true"' : '' ?>>
                <span class="flag-icon" aria-hidden="true"><?= $langFlags[$lang] ?></span>
                <span><?= e($langNames[$lang]) ?></span>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
