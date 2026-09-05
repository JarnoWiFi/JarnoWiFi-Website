<?php
require __DIR__ . '/partials/i18n-boot.php';
require __DIR__ . '/partials/blog.php';

$metaTitleKey       = 'meta.title';
$metaDescriptionKey = 'meta.description';
$metaImage          = '/img/opt/og-default.png';
$activeNav          = '';

$faqKeys = ['1', '2', '3', '4', '5', '6', '7'];
$plans = [
    ['key' => 'card1', 'featured' => false],
    ['key' => 'card2', 'featured' => true],
    ['key' => 'card3', 'featured' => false],
];

// Structured data: FAQ + the three plans, generated from the same catalog the
// page renders so they can never disagree with what a visitor sees.
$jsonLd = ['@graph' => [
    [
        '@type' => 'FAQPage',
        'mainEntity' => array_map(fn($n) => [
            '@type' => 'Question',
            'name' => t("faq.q{$n}"),
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => t("faq.a{$n}")],
        ], $faqKeys),
    ],
    [
        '@type' => 'Service',
        'name' => t('meta.title'),
        'provider' => ['@id' => siteOrigin() . '/#business'],
        'offers' => array_map(fn($p) => [
            '@type' => 'Offer',
            'name' => t("pricing.{$p['key']}.title"),
            'description' => t("pricing.{$p['key']}.subtitle"),
            'priceCurrency' => 'EUR',
            'priceSpecification' => [
                '@type' => 'PriceSpecification',
                'price' => (int) filter_var(t("pricing.{$p['key']}.price"), FILTER_SANITIZE_NUMBER_INT),
                'priceCurrency' => 'EUR',
            ],
        ], $plans),
    ],
]];

$gallery = [
    ['stem' => 'gallery-01', 'alt' => 'gallery.alt1', 'w' => 1200, 'h' => 900],
    ['stem' => 'gallery-02', 'alt' => 'gallery.alt2', 'w' => 1200, 'h' => 900],
    ['stem' => 'gallery-03', 'alt' => 'gallery.alt3', 'w' => 1200, 'h' => 1600],
    ['stem' => 'gallery-04', 'alt' => 'gallery.alt4', 'w' => 1200, 'h' => 1600],
    ['stem' => 'gallery-05', 'alt' => 'gallery.alt5', 'w' => 1200, 'h' => 1600],
    ['stem' => 'gallery-06', 'alt' => 'gallery.alt6', 'w' => 1200, 'h' => 1600],
    ['stem' => 'gallery-07', 'alt' => 'gallery.alt7', 'w' => 1200, 'h' => 1600],
    ['stem' => 'gallery-08', 'alt' => 'gallery.alt8', 'w' => 1200, 'h' => 900],
    ['stem' => 'gallery-09', 'alt' => 'gallery.alt9', 'w' => 1200, 'h' => 1600],
];
?>
<!doctype html>
<html lang="<?= e($currentLang) ?>">
  <head>
    <?php include __DIR__ . '/partials/meta-common.php'; ?>
  </head>
  <body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <main id="main">
      <section class="hero text-white" id="home">
        <img class="hero-bg-media" src="/img/opt/hero-poster.webp" alt="" width="1100" height="620" fetchpriority="high" />
        <video class="hero-bg-media hero-bg-video" muted loop playsinline preload="none"
               poster="/img/opt/hero-poster.webp" aria-hidden="true" data-hero-video hidden>
          <source src="/img/background-video-1-webbg-20fps-420p.mp4" type="video/mp4" />
        </video>
        <div class="container hero-content">
          <div class="row align-items-center g-5">
            <div class="col-lg-7">
              <p class="section-label"><?= te('hero.label') ?></p>
              <h1 class="display-4 fw-bold mb-3 fade-up"><span class="text-gradient"><?= te('hero.title') ?></span></h1>
              <p class="lead fade-up delay-1"><?= te('hero.lead') ?></p>
              <div class="d-flex flex-wrap gap-3 fade-up delay-2">
                <a class="btn btn-lg cta-primary" href="#contact"><?= te('hero.ctaPrimary') ?></a>
                <a class="btn btn-lg cta-outline" href="<?= e(langUrl('/jobs')) ?>"><?= te('hero.jobsLink') ?></a>
              </div>
              <ul class="d-flex flex-wrap gap-3 mt-4 list-unstyled mb-0">
                <?php foreach (['stat1', 'stat2', 'stat3', 'stat4'] as $stat): ?>
                <li class="stat-chip"><?= te("hero.{$stat}") ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="col-lg-5">
              <div class="glass-card p-4 floating">
                <h2 class="h5 fw-semibold"><?= te('hero.snapshot.title') ?></h2>
                <p class="text-white-50 mb-4"><?= te('hero.snapshot.desc') ?></p>
                <dl class="mb-0 snapshot-list">
                  <?php foreach (['capacity', 'throughput', 'setup', 'support'] as $row): ?>
                  <div class="snapshot-row">
                    <dt class="fw-normal"><?= te("hero.snapshot.{$row}") ?></dt>
                    <dd class="fw-semibold mb-0"><?= te("hero.snapshot.{$row}Value") ?></dd>
                  </div>
                  <?php endforeach; ?>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="py-5 pattern-bg" id="services">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-8">
              <p class="section-label"><?= te('services.label') ?></p>
              <h2 class="fw-bold"><?= te('services.title') ?></h2>
              <p class="text-muted"><?= te('services.lead') ?></p>
            </div>
          </div>
          <div class="row g-4">
            <?php foreach (['card1', 'card2', 'card3', 'card4'] as $i => $card): ?>
            <div class="col-md-6 col-lg-3">
              <div class="card service-card h-100 fade-up delay-<?= $i + 1 ?>">
                <div class="card-body">
                  <h3 class="h5 fw-semibold"><?= te("services.{$card}.title") ?></h3>
                  <p class="text-muted mb-0"><?= te("services.{$card}.body") ?></p>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="reliability py-5" id="reliability">
        <div class="container py-4">
          <div class="row align-items-center g-5">
            <div class="col-lg-6">
              <p class="section-label"><?= te('reliability.label') ?></p>
              <h2 class="fw-bold"><?= te('reliability.title') ?></h2>
              <p class="text-white-50"><?= te('reliability.lead') ?></p>
              <ul class="check-list text-white-50 mb-0">
                <?php foreach (['item1', 'item2', 'item3', 'item4'] as $item): ?>
                <li class="mb-2"><?= te("reliability.{$item}") ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="col-lg-6">
              <div class="diagram fade-up">
                <?php foreach ([
                  ['primary', 'text-bg-light'],
                  ['backup', 'text-bg-warning'],
                  ['output', 'text-bg-info'],
                ] as [$row, $badge]): ?>
                <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
                  <span class="badge <?= $badge ?>"><?= te("reliability.diagram.{$row}Label") ?></span>
                  <span class="fw-semibold text-end"><?= te("reliability.diagram.{$row}Value") ?></span>
                </div>
                <?php endforeach; ?>
                <p class="mt-4 mb-0 small text-white-50"><?= te('reliability.diagram.note') ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="py-5" id="use-cases">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-7">
              <p class="section-label"><?= te('useCases.label') ?></p>
              <h2 class="fw-bold"><?= te('useCases.title') ?></h2>
            </div>
          </div>
          <div class="row g-4">
            <?php for ($i = 1; $i <= 7; $i++): ?>
            <div class="col-md-6 col-lg-4">
              <div class="card use-case-card h-100 fade-up delay-<?= $i ?>">
                <div class="card-body">
                  <h3 class="h5 fw-semibold"><?= te("useCases.card{$i}.title") ?></h3>
                  <p class="text-muted mb-0"><?= te("useCases.card{$i}.body") ?></p>
                </div>
              </div>
            </div>
            <?php endfor; ?>
          </div>
        </div>
      </section>

      <section class="py-5 pattern-bg" id="pos-markets">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-7">
              <p class="section-label"><?= te('pos.label') ?></p>
              <h2 class="fw-bold"><?= te('pos.title') ?></h2>
              <p class="text-muted"><?= te('pos.lead') ?></p>
            </div>
          </div>
          <div class="row g-4">
            <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="col-md-6 col-lg-3">
              <div class="card service-card h-100 fade-up delay-<?= $i ?>">
                <div class="card-body">
                  <h3 class="h5 fw-semibold"><?= te("pos.card{$i}.title") ?></h3>
                  <p class="text-muted mb-0"><?= te("pos.card{$i}.body") ?></p>
                </div>
              </div>
            </div>
            <?php endfor; ?>
          </div>
        </div>
      </section>

      <section class="py-5" id="video-surveillance">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-7">
              <p class="section-label"><?= te('video.label') ?></p>
              <h2 class="fw-bold"><?= te('video.title') ?></h2>
              <p class="text-muted"><?= te('video.lead') ?></p>
            </div>
          </div>
          <div class="row g-4">
            <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="col-md-6 col-lg-3">
              <div class="card service-card h-100 fade-up delay-<?= $i ?>">
                <div class="card-body">
                  <h3 class="h5 fw-semibold"><?= te("video.card{$i}.title") ?></h3>
                  <p class="text-muted mb-0"><?= te("video.card{$i}.body") ?></p>
                </div>
              </div>
            </div>
            <?php endfor; ?>
          </div>
        </div>
      </section>

      <section class="py-5" id="gallery">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-7">
              <p class="section-label"><?= te('gallery.label') ?></p>
              <h2 class="fw-bold"><?= te('gallery.title') ?></h2>
              <p class="text-muted"><?= te('gallery.lead') ?></p>
            </div>
          </div>
          <div class="row g-3">
            <?php foreach ($gallery as $item): ?>
            <div class="col-6 col-md-4 col-lg-3">
              <button type="button" class="gallery-trigger ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm"
                      data-enlarge aria-label="<?= te('a11y.enlarge') ?>: <?= te($item['alt']) ?>">
                <img
                  src="/img/opt/<?= e($item['stem']) ?>-800.webp"
                  srcset="/img/opt/<?= e($item['stem']) ?>-400.webp 400w,
                          /img/opt/<?= e($item['stem']) ?>-800.webp 800w,
                          /img/opt/<?= e($item['stem']) ?>-1200.webp 1200w"
                  sizes="(max-width: 576px) 50vw, (max-width: 992px) 33vw, 25vw"
                  width="<?= (int) $item['w'] ?>" height="<?= (int) $item['h'] ?>"
                  class="gallery-img" alt="<?= te($item['alt']) ?>" loading="lazy" decoding="async" />
              </button>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="py-5" id="blog">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-7">
              <p class="section-label"><?= te('blog.label') ?></p>
              <h2 class="fw-bold"><?= te('blog.title') ?></h2>
              <p class="text-muted"><?= te('blog.lead') ?></p>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
            <h3 class="h5 fw-semibold mb-0"><?= te('blog.localTitle') ?></h3>
            <a class="text-decoration-none" href="<?= e(langUrl('/blog')) ?>"><?= te('blog.allLink') ?></a>
          </div>
          <div class="row g-4">
            <?php
            $posts = array_slice(loadBlogPosts(), 0, 3);
            if (!$posts): ?>
            <p class="text-muted small mb-0"><?= te('blog.empty') ?></p>
            <?php else: foreach ($posts as $post): ?>
            <div class="col-md-6 col-lg-4">
              <?php renderPostCard($post); ?>
            </div>
            <?php endforeach; endif; ?>
          </div>
        </div>
      </section>

      <section class="py-5" id="team">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-7">
              <p class="section-label"><?= te('team.label') ?></p>
              <h2 class="fw-bold"><?= te('team.title') ?></h2>
              <p class="text-muted"><?= te('team.lead') ?></p>
            </div>
          </div>
          <div class="row g-4">
            <?php foreach ([
              ['name' => 'Jarno Sulmann',   'stem' => 'jarno',  'role' => 'team.role1', 'email' => 'jarno@jarnowifi.net'],
              ['name' => 'Joshua Treudler', 'stem' => 'joshua', 'role' => 'team.role2', 'email' => 'joshua@jarnowifi.net'],
            ] as $member): ?>
            <div class="col-md-6 col-lg-4">
              <div class="card service-card h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center gap-3">
                    <img src="/img/opt/<?= e($member['stem']) ?>-160.webp"
                         srcset="/img/opt/<?= e($member['stem']) ?>-160.webp 160w,
                                 /img/opt/<?= e($member['stem']) ?>-320.webp 320w"
                         sizes="80px" width="80" height="80"
                         alt="<?= e($member['name']) ?>"
                         class="avatar rounded-circle flex-shrink-0" loading="lazy" decoding="async" />
                    <div>
                      <h3 class="h5 fw-semibold mb-1"><?= e($member['name']) ?></h3>
                      <p class="text-muted mb-0"><?= te($member['role']) ?></p>
                      <a class="small text-decoration-none" href="mailto:<?= e($member['email']) ?>"><?= e($member['email']) ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
            <div class="col-md-6 col-lg-4">
              <div class="card service-card h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center gap-3">
                    <span class="avatar avatar-placeholder rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center" aria-hidden="true">?</span>
                    <div>
                      <h3 class="h5 fw-semibold mb-1"><?= te('team.card3.name') ?></h3>
                      <ul class="text-muted small list-unstyled mb-1">
                        <li><?= te('team.role3') ?></li>
                        <li><?= te('team.role4') ?></li>
                      </ul>
                      <a class="small text-decoration-none" href="<?= e(langUrl('/jobs')) ?>"><?= te('team.card3.cta') ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="py-5 pattern-bg" id="pricing">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-7">
              <p class="section-label"><?= te('pricing.label') ?></p>
              <h2 class="fw-bold"><?= te('pricing.title') ?></h2>
              <p class="text-muted"><?= te('pricing.lead') ?></p>
              <p class="mb-2"><span class="discount-pill"><?= te('pricing.discount') ?></span></p>
              <p class="text-muted small mb-1"><?= te('pricing.note') ?></p>
              <p class="text-muted small mb-0"><?= te('pricing.capacityNote') ?></p>
            </div>
          </div>
          <div class="row g-4 align-items-stretch">
            <?php foreach ($plans as $plan): $k = $plan['key']; ?>
            <div class="col-lg-4">
              <div class="plan-card h-100 p-4<?= $plan['featured'] ? ' featured' : '' ?>">
                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                  <h3 class="h5 fw-semibold mb-0"><?= te("pricing.{$k}.title") ?></h3>
                  <?php if ($plan['featured']): ?>
                  <span class="badge text-bg-warning"><?= te('pricing.card2.badge') ?></span>
                  <?php endif; ?>
                </div>
                <p class="text-muted small"><?= te("pricing.{$k}.subtitle") ?></p>
                <p class="plan-price fw-bold"><?= te("pricing.{$k}.price") ?></p>
                <p class="mb-4"><span class="discount-pill"><?= te("pricing.{$k}.discount") ?></span></p>
                <ul class="text-muted list-unstyled mb-0">
                  <?php foreach (['item1', 'item2', 'item3'] as $item): ?>
                  <li class="plan-item"><?= te("pricing.{$k}.{$item}") ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="py-5" id="long-term-offers">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-7">
              <p class="section-label"><?= te('longterm.label') ?></p>
              <h2 class="fw-bold"><?= te('longterm.title') ?></h2>
              <p class="text-muted"><?= te('longterm.lead') ?></p>
              <p class="text-muted small mb-2"><?= te('longterm.billing') ?></p>
              <p class="text-muted small mb-0"><?= te('longterm.fiberNote') ?></p>
            </div>
          </div>
          <div class="row g-4 align-items-stretch">
            <?php foreach (['card1', 'card2'] as $k): ?>
            <div class="col-md-6">
              <div class="plan-card h-100 p-4">
                <h3 class="h5 fw-semibold"><?= te("longterm.{$k}.title") ?></h3>
                <p class="plan-price fw-bold"><?= te("longterm.{$k}.price") ?></p>
                <p class="text-muted mb-3"><?= te("longterm.{$k}.capacity") ?></p>
                <ul class="text-muted list-unstyled mb-0">
                  <?php foreach (['item1', 'item2', 'item3'] as $item): ?>
                  <li class="plan-item"><?= te("longterm.{$k}.{$item}") ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="py-5" id="faq">
        <div class="container py-4">
          <div class="row mb-4">
            <div class="col-lg-6">
              <p class="section-label"><?= te('faq.label') ?></p>
              <h2 class="fw-bold"><?= te('faq.title') ?></h2>
            </div>
          </div>
          <div class="accordion" id="faqAccordion">
            <?php foreach ($faqKeys as $i => $n): ?>
            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button<?= $i === 0 ? '' : ' collapsed' ?>" type="button"
                        data-bs-toggle="collapse" data-bs-target="#faq<?= $n ?>"
                        aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="faq<?= $n ?>">
                  <?= te("faq.q{$n}") ?>
                </button>
              </h3>
              <div id="faq<?= $n ?>" class="accordion-collapse collapse<?= $i === 0 ? ' show' : '' ?>" data-bs-parent="#faqAccordion">
                <div class="accordion-body"><?= te("faq.a{$n}") ?></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section class="py-5" id="contact">
        <div class="container py-4">
          <div class="cta-band mb-5">
            <div class="row align-items-center">
              <div class="col-lg-8">
                <h2 class="fw-bold"><?= te('contact.cta.title') ?></h2>
                <p class="mb-0"><?= te('contact.cta.lead') ?></p>
              </div>
              <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a class="btn btn-dark btn-lg" href="mailto:contact@jarnowifi.net">contact@jarnowifi.net</a>
              </div>
            </div>
          </div>

          <div class="row g-4">
            <div class="col-lg-5">
              <h3 class="fw-semibold"><?= te('contact.info.title') ?></h3>
              <p class="text-muted"><?= te('contact.info.lead') ?></p>
              <dl class="contact-list mb-0">
                <div class="contact-row">
                  <dt><?= te('contact.info.phoneLabel') ?></dt>
                  <dd class="mb-0"><a href="tel:+4969175549160"><?= te('contact.info.phoneValue') ?></a></dd>
                </div>
                <?php foreach (['response', 'coverage', 'support'] as $row): ?>
                <div class="contact-row">
                  <dt><?= te("contact.info.{$row}Label") ?></dt>
                  <dd class="mb-0"><?= te("contact.info.{$row}Value") ?></dd>
                </div>
                <?php endforeach; ?>
              </dl>
            </div>
            <div class="col-lg-7">
              <form class="row g-3" action="/contact.php" method="post" accept-charset="UTF-8"
                    data-contact-form
                    data-msg-sending="<?= te('contact.form.sending') ?>"
                    data-msg-success="<?= te('contact.form.success') ?>"
                    data-msg-error="<?= te('contact.form.error') ?>">
                <input type="hidden" name="lang" value="<?= e($currentLang) ?>" />
                <div class="col-md-6">
                  <label class="form-label" for="contact-name"><?= te('contact.form.nameLabel') ?></label>
                  <input type="text" class="form-control" id="contact-name" name="full_name"
                         autocomplete="name" maxlength="120"
                         placeholder="<?= te('contact.form.namePlaceholder') ?>" />
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="contact-email"><?= te('contact.form.emailLabel') ?></label>
                  <input type="email" class="form-control" id="contact-email" name="email"
                         autocomplete="email" maxlength="200" required
                         placeholder="<?= te('contact.form.emailPlaceholder') ?>" />
                </div>
                <div class="col-12">
                  <label class="form-label" for="contact-notes"><?= te('contact.form.notesLabel') ?></label>
                  <textarea class="form-control" id="contact-notes" name="notes" rows="4" maxlength="5000" required
                            placeholder="<?= te('contact.form.notesPlaceholder') ?>"></textarea>
                </div>
                <div class="col-12 d-none" aria-hidden="true">
                  <label for="website-field">Website</label>
                  <input type="text" id="website-field" name="website" tabindex="-1" autocomplete="off" />
                </div>
                <div class="col-12">
                  <p class="text-muted small mb-0">
                    <?= te('contact.form.privacyNote') ?>
                    <a href="<?= e(langUrl('/privacy')) ?>"><?= te('privacy.title') ?></a>
                  </p>
                </div>
                <div class="col-12">
                  <div class="alert d-none mb-0" role="status" aria-live="polite" data-contact-status></div>
                </div>
                <div class="col-12">
                  <button class="btn btn-lg cta-primary w-100" type="submit"><?= te('contact.form.submit') ?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>

    <?php
      include __DIR__ . '/partials/footer.php';
      include __DIR__ . '/partials/modal.php';
      include __DIR__ . '/partials/consent.php';
      include __DIR__ . '/partials/scripts.php';
    ?>
  </body>
</html>
