<?php
require __DIR__ . '/partials/i18n-boot.php';
require __DIR__ . '/partials/blog.php';

header('Content-Type: application/xml; charset=UTF-8');

$origin = siteOrigin();
$paths  = ['/', '/reliability', '/jobs', '/blog', '/imprint', '/privacy'];
foreach (loadBlogPosts() as $post) {
    $paths[] = '/blog/' . $post['slug'];
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach ($paths as $path): ?>
  <?php foreach (SUPPORTED_LANGS as $lang): ?>
  <url>
    <loc><?= e($origin . ($path === '/' ? "/{$lang}/" : "/{$lang}{$path}")) ?></loc>
    <?php foreach (SUPPORTED_LANGS as $alt): ?>
    <xhtml:link rel="alternate" hreflang="<?= e($alt) ?>" href="<?= e($origin . ($path === '/' ? "/{$alt}/" : "/{$alt}{$path}")) ?>" />
    <?php endforeach; ?>
    <xhtml:link rel="alternate" hreflang="x-default" href="<?= e($origin . ($path === '/' ? '/nl/' : "/nl{$path}")) ?>" />
    <changefreq><?= $path === '/' ? 'weekly' : 'monthly' ?></changefreq>
    <priority><?= $path === '/' ? '1.0' : '0.7' ?></priority>
  </url>
  <?php endforeach; ?>
<?php endforeach; ?>
</urlset>
