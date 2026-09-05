<?php
/** Blog data loading and rendering. Posts are server-rendered so each one has
 *  a real, crawlable URL and its own metadata. */
declare(strict_types=1);

const IMG_WIDTHS = [400, 800, 1200];

/** @return array<int, array<string, mixed>> newest first */
function loadBlogPosts(): array
{
    static $posts = null;
    if ($posts !== null) {
        return $posts;
    }

    $file = __DIR__ . '/../data/blog-posts.json';
    $data = is_readable($file)
        ? json_decode((string) file_get_contents($file), true)
        : null;

    $posts = is_array($data['posts'] ?? null) ? $data['posts'] : [];
    usort($posts, static fn($a, $b) => strcmp($b['date'] ?? '', $a['date'] ?? ''));
    return $posts;
}

function findBlogPost(string $slug): ?array
{
    foreach (loadBlogPosts() as $post) {
        if (($post['slug'] ?? '') === $slug) {
            return $post;
        }
    }
    return null;
}

/**
 * Month names per locale. The php:8.2-fpm-alpine image ships without ext-intl,
 * so we cannot rely on IntlDateFormatter being present.
 */
const MONTH_NAMES = [
    'nl' => ['januari', 'februari', 'maart', 'april', 'mei', 'juni',
             'juli', 'augustus', 'september', 'oktober', 'november', 'december'],
    'en' => ['January', 'February', 'March', 'April', 'May', 'June',
             'July', 'August', 'September', 'October', 'November', 'December'],
    'de' => ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
             'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
];

/** Format an ISO date in the visitor's language. */
function formatPostDate(string $iso): string
{
    global $currentLang;

    $time = strtotime($iso);
    if ($time === false) {
        return $iso;
    }

    if (class_exists('IntlDateFormatter')) {
        $locale = ['nl' => 'nl_NL', 'en' => 'en_GB', 'de' => 'de_DE'][$currentLang] ?? 'nl_NL';
        $formatted = (new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format($time);
        if ($formatted !== false) {
            return (string) $formatted;
        }
    }

    $months = MONTH_NAMES[$currentLang] ?? MONTH_NAMES['nl'];
    $day    = (int) date('j', $time);
    $month  = $months[(int) date('n', $time) - 1];
    $year   = date('Y', $time);

    // English leads with the month; German writes an ordinal day ("14. März").
    return match ($currentLang) {
        'en'    => "{$month} {$day}, {$year}",
        'de'    => "{$day}. {$month} {$year}",
        default => "{$day} {$month} {$year}",
    };
}

/** Which generated widths exist for this image stem. */
function imageVariants(string $stem): array
{
    $found = [];
    foreach (IMG_WIDTHS as $w) {
        if (is_file(__DIR__ . "/../img/opt/{$stem}-{$w}.webp")) {
            $found[] = $w;
        }
    }
    return $found;
}

/** Responsive <img> for a generated image stem. */
function renderImage(string $stem, string $alt, string $class = '', string $sizes = '100vw', bool $lazy = true): void
{
    $widths = imageVariants($stem);
    if (!$widths) {
        return;
    }
    $largest = max($widths);
    $dims = @getimagesize(__DIR__ . "/../img/opt/{$stem}-{$largest}.webp") ?: [$largest, $largest];
    $srcset = implode(', ', array_map(
        static fn($w) => "/img/opt/{$stem}-{$w}.webp {$w}w",
        $widths
    ));
    printf(
        '<img src="/img/opt/%s-%d.webp" srcset="%s" sizes="%s" width="%d" height="%d" alt="%s" class="%s"%s decoding="async" />',
        e($stem), $widths[0], e($srcset), e($sizes),
        (int) $dims[0], (int) $dims[1], e($alt), e($class),
        $lazy ? ' loading="lazy"' : ''
    );
}

function renderPostCard(array $post): void
{
    $url = langUrl('/blog/' . ($post['slug'] ?? ''));
    ?>
    <a class="blog-link d-block h-100" href="<?= e($url) ?>">
      <article class="card blog-card h-100">
        <?php if (!empty($post['cover'])): ?>
        <div class="ratio ratio-16x9 blog-card__cover-wrap">
          <?php renderImage($post['cover'], (string) ($post['coverAlt'] ?? ''), 'blog-card__cover', '(max-width: 768px) 100vw, 33vw'); ?>
        </div>
        <?php endif; ?>
        <div class="card-body">
          <p class="blog-meta mb-1">
            <time datetime="<?= e((string) ($post['date'] ?? '')) ?>"><?= e(formatPostDate((string) ($post['date'] ?? ''))) ?></time>
          </p>
          <h3 class="h5 fw-semibold"><?= e((string) ($post['title'] ?? '')) ?></h3>
          <p class="text-muted mb-0"><?= e((string) ($post['excerpt'] ?? '')) ?></p>
        </div>
      </article>
    </a>
    <?php
}
