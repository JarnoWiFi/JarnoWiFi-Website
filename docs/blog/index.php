<!doctype html>
<html lang="en">
  <head>
    <?php
      $metaTitle = 'Blog — JarnoWiFi';
      $metaDescriptionKey = 'blog.lead';
      $metaImage = '/img/people/joshua.jpeg';
    ?>
    <?php include '../partials/meta-common.php'; ?>
    <title>Blog - JarnoWiFi</title>
  </head>
  <body>
    <div data-include="header" data-active="blog"></div>

    <main class="page-shell">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <div class="alert alert-info" role="status" data-post-status>Loading post...</div>

            <article class="d-none" data-post-article>
              <p class="section-label mb-2">Blog</p>
              <h1 class="fw-bold mb-3" data-post-title></h1>
              <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                <span class="post-meta" data-post-date></span>
                <div class="d-flex flex-wrap gap-2" data-post-tags></div>
              </div>
              <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm mb-4 d-none" data-post-cover>
                <img class="w-100 h-100" alt="" loading="lazy" data-post-cover-img />
              </div>
              <div class="post-content text-muted" data-post-content></div>
              <div class="post-gallery row g-3 mt-4 d-none" data-post-gallery></div>
            </article>

            <div class="mt-5 d-none" data-post-list>
              <h4 class="fw-semibold mb-3">More posts</h4>
              <div class="row g-4" data-post-list-container></div>
              <div class="mt-5">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                  <h4 class="fw-semibold mb-0">PD0DP feed</h4>
                  <a class="text-decoration-none" href="/blog/sources/pd0dp-feed.xml" target="_blank" rel="noopener">XML</a>
                </div>
                <div class="row g-4" data-feed-list></div>
                <p class="text-muted small mb-0 d-none" data-feed-status>Unable to load the feed right now.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?php include '../partials/footer.php'; ?>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script type="module">
      import { i18n } from '/js/i18n.js';
      import { loadBlogPost, loadBlogPostList, loadPD0DPFeed, setupImageEnlargement } from '/js/blog-helpers.js';
      
      document.addEventListener('DOMContentLoaded', async () => {
        await import('/menu.js');
        await i18n.init();
        await window.loadHeader({ active: 'blog' });
        await window.loadFooter();
        
        // Load blog post or list
        const postId = new URL(window.location.href).searchParams.get('post');
        if (postId) {
          await loadBlogPost(postId);
        } else {
          await loadBlogPostList();
          await loadPD0DPFeed();
        }
        
        setupImageEnlargement();
      });
    </script>

    <?php include '../partials/modal.php'; ?>
  </body>
</html>
