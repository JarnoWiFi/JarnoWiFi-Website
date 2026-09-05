<?php
require __DIR__ . '/../partials/i18n-boot.php';
require __DIR__ . '/../partials/blog.php';

// /<lang>/blog/<slug> — nginx rewrites to this file, slug arrives in the path.
$slug = '';
if (preg_match('#^/blog/([a-z0-9-]+)/?$#', $pagePath, $m)) {
    $slug = $m[1];
}

$post = $slug !== '' ? findBlogPost($slug) : null;
if ($slug !== '' && $post === null) {
    http_response_code(404);
}

$activeNav = 'blog';

if ($post) {
    $metaTitle       = $post['title'] . ' — JarnoWiFi';
    $metaDescription = (string) ($post['excerpt'] ?? '');
    $metaType        = 'article';
    if (!empty($post['cover']) && is_file(__DIR__ . '/../img/opt/' . $post['cover'] . '-1200.webp')) {
        $metaImage = '/img/opt/' . $post['cover'] . '-1200.webp';
    }
    $jsonLd = [
        '@type'         => 'BlogPosting',
        'headline'      => $post['title'],
        'description'   => $post['excerpt'] ?? '',
        'datePublished' => $post['date'] ?? '',
        'inLanguage'    => $post['lang'] ?? 'nl',
        'author'        => ['@type' => 'Organization', 'name' => 'JarnoWiFi'],
        'publisher'     => ['@id' => siteOrigin() . '/#business'],
        'mainEntityOfPage' => siteOrigin() . langUrl('/blog/' . $post['slug']),
    ];
} else {
    $metaTitle          = t('blog.title') . ' — JarnoWiFi';
    $metaDescriptionKey = 'blog.lead';
    $metaImage          = '/img/opt/og-default.png';
}
?>
<!doctype html>
<html lang="<?= e($currentLang) ?>">
  <head>
    <?php include __DIR__ . '/../partials/meta-common.php'; ?>
  </head>
  <body>
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <main id="main" class="page-shell">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-9">

            <?php if ($post): ?>
            <nav class="mb-4" aria-label="breadcrumb">
              <a class="text-decoration-none" href="<?= e(langUrl('/blog')) ?>">&larr; <?= te('blog.backToList') ?></a>
            </nav>
            <article>
              <p class="section-label mb-2"><?= te('blog.label') ?></p>
              <h1 class="fw-bold mb-3"><?= e((string) $post['title']) ?></h1>
              <p class="blog-meta d-flex flex-wrap align-items-center gap-2 mb-4">
                <time datetime="<?= e((string) $post['date']) ?>"><?= e(formatPostDate((string) $post['date'])) ?></time>
                <?php foreach (($post['tags'] ?? []) as $tag): ?>
                <span class="tag-pill"><?= e((string) $tag) ?></span>
                <?php endforeach; ?>
              </p>

              <?php if (!empty($post['cover'])): ?>
              <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm mb-4">
                <?php renderImage($post['cover'], (string) ($post['coverAlt'] ?? ''), 'w-100 h-100 gallery-img', '(max-width: 992px) 100vw, 720px', false); ?>
              </div>
              <?php endif; ?>

              <div class="post-content">
                <?php foreach (($post['sections'] ?? []) as $section): ?>
                  <?php if (!empty($section['heading'])): ?>
                  <h2 class="h4 fw-semibold mt-5 mb-3"><?= e((string) $section['heading']) ?></h2>
                  <?php endif; ?>
                  <?php foreach (($section['body'] ?? []) as $paragraph): ?>
                  <p><?= e((string) $paragraph) ?></p>
                  <?php endforeach; ?>
                  <?php if (!empty($section['images'])): ?>
                  <div class="row g-3 my-4">
                    <?php foreach ($section['images'] as $stem): ?>
                    <div class="col-6 col-md-4">
                      <button type="button" class="gallery-trigger ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm"
                              data-enlarge aria-label="<?= te('a11y.enlarge') ?>">
                        <?php renderImage((string) $stem, '', 'gallery-img', '(max-width: 768px) 50vw, 240px'); ?>
                      </button>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </article>

            <?php $others = array_filter(loadBlogPosts(), fn($p) => $p['slug'] !== $post['slug']); ?>
            <?php if ($others): ?>
            <section class="mt-5 pt-4 border-top">
              <h2 class="h5 fw-semibold mb-3"><?= te('blog.morePosts') ?></h2>
              <div class="row g-4">
                <?php foreach ($others as $other): ?>
                <div class="col-md-6"><?php renderPostCard($other); ?></div>
                <?php endforeach; ?>
              </div>
            </section>
            <?php endif; ?>

            <?php else: ?>
            <header class="mb-4">
              <p class="section-label mb-2"><?= te('blog.label') ?></p>
              <h1 class="fw-bold mb-3"><?= te('blog.title') ?></h1>
              <p class="text-muted"><?= te('blog.lead') ?></p>
            </header>

            <?php $posts = loadBlogPosts(); ?>
            <?php if (!$posts): ?>
            <p class="text-muted"><?= te('blog.empty') ?></p>
            <?php else: ?>
            <div class="row g-4">
              <?php foreach ($posts as $item): ?>
              <div class="col-md-6"><?php renderPostCard($item); ?></div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </main>

    <?php
      include __DIR__ . '/../partials/footer.php';
      include __DIR__ . '/../partials/modal.php';
      include __DIR__ . '/../partials/consent.php';
      include __DIR__ . '/../partials/scripts.php';
    ?>
  </body>
</html>
