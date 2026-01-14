/**
 * Blog Helpers - Unified blog card rendering
 */

/**
 * Format blog post date
 */
export function formatBlogDate(dateString) {
  if (!dateString) return '';
  
  try {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return date.toLocaleDateString('nl-NL', options);
  } catch (error) {
    console.error('Error formatting date:', error);
    return dateString;
  }
}

/**
 * Create a blog card element
 * @param {Object} post - Blog post object
 * @param {Object} options - Configuration options
 * @returns {HTMLElement} Card element
 */
export function createBlogCard(post, options = {}) {
  const {
    linkTarget = null,
    showCover = true,
    showThumbs = true,
    maxThumbs = 3
  } = options;

  // Create card container
  const card = document.createElement('div');
  card.className = 'card blog-card h-100';

  // Add cover image if present
  if (showCover && post.cover) {
    const ratio = document.createElement('div');
    ratio.className = 'ratio ratio-16x9';
    const img = document.createElement('img');
    img.className = 'w-100 h-100 blog-card__cover enlargeable';
    img.src = post.cover;
    img.alt = post.title || '';
    img.loading = 'lazy';
    ratio.appendChild(img);
    card.appendChild(ratio);
  }

  // Create card body
  const body = document.createElement('div');
  body.className = 'card-body d-flex flex-column';

  // Add date meta
  if (post.date) {
    const meta = document.createElement('p');
    meta.className = 'blog-meta mb-2';
    meta.textContent = formatBlogDate(post.date);
    body.appendChild(meta);
  }

  // Add title
  if (linkTarget) {
    const titleLink = document.createElement('a');
    titleLink.className = 'fw-semibold blog-link stretched-link';
    titleLink.textContent = post.title || '';
    titleLink.href = linkTarget;
    titleLink.setAttribute('aria-label', post.title || 'Open post');
    body.appendChild(titleLink);
  } else {
    const title = document.createElement('h5');
    title.className = 'fw-semibold';
    title.textContent = post.title || '';
    body.appendChild(title);
  }

  // Add excerpt
  if (post.excerpt) {
    const excerpt = document.createElement('p');
    excerpt.className = 'text-muted mt-2 mb-0 flex-grow-1';
    excerpt.textContent = post.excerpt;
    body.appendChild(excerpt);
  }

  // Add image thumbnails
  if (showThumbs && Array.isArray(post.images) && post.images.length > 0) {
    const thumbs = document.createElement('div');
    thumbs.className = 'blog-thumbs mt-3';
    post.images.slice(0, maxThumbs).forEach((image) => {
      const thumb = document.createElement('img');
      thumb.className = 'blog-thumb';
      thumb.src = image;
      thumb.alt = post.title || '';
      thumb.loading = 'lazy';
      thumbs.appendChild(thumb);
    });
    body.appendChild(thumbs);
  }

  card.appendChild(body);
  return card;
}

/**
 * Load and display blog posts
 * @param {string} containerId - ID of container element
 * @param {string} dataUrl - URL to fetch blog data from
 * @param {Object} options - Configuration options
 */
export async function loadBlogPosts(containerId, dataUrl, options = {}) {
  const {
    limit = null,
    emptyMessage = 'No posts yet.',
    errorMessage = 'Unable to load posts right now.',
    linkPattern = null // e.g., '/blog/{{id}}' or null
  } = options;

  const container = document.getElementById(containerId);
  if (!container) {
    console.warn(`Container #${containerId} not found`);
    return;
  }

  try {
    const response = await fetch(dataUrl);
    if (!response.ok) {
      throw new Error(`Failed to load blog posts: ${response.status}`);
    }

    const data = await response.json();
    let posts = Array.isArray(data) ? data : (data.posts || []);

    // Apply limit if specified
    if (limit && posts.length > limit) {
      posts = posts.slice(0, limit);
    }

    // Clear container
    container.innerHTML = '';

    if (posts.length === 0) {
      container.innerHTML = `<p class="text-muted text-center">${emptyMessage}</p>`;
      return;
    }

    // Create cards
    posts.forEach((post) => {
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4 mb-4';
      
      const linkTarget = linkPattern ? linkPattern.replace('{{id}}', post.id || '') : null;
      const card = createBlogCard(post, { linkTarget });
      
      col.appendChild(card);
      container.appendChild(col);
    });

  } catch (error) {
    console.error('Error loading blog posts:', error);
    container.innerHTML = `<p class="text-danger text-center">${errorMessage}</p>`;
  }
}

/**
 * Setup image enlargement modal
 */
export function setupImageEnlargement() {
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('enlargeable')) {
      const src = e.target.src;
      const modalImage = document.getElementById('modalImage');
      if (modalImage) {
        modalImage.src = src;
        modalImage.alt = e.target.alt || 'Enlarged image';
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
      }
    }
  });
}

/**
 * Load and display a single blog post
 * @param {string} postId - The ID of the post to load
 */
export async function loadBlogPost(postId) {
  const articleEl = document.querySelector('[data-post-article]');
  
  try {
    const response = await fetch('/data/blog-posts.json');
    if (!response.ok) {
      throw new Error(`Failed to load blog posts: ${response.status}`);
    }
    
    const data = await response.json();
    const post = data.posts.find(p => p.id === postId);
    
    if (!post) {
      throw new Error('Post not found');
    }
    
    // Show article
    articleEl.classList.remove('d-none');
    
    // Set title
    const titleEl = articleEl.querySelector('[data-post-title]');
    if (titleEl) titleEl.textContent = post.title || '';
    
    // Set date
    const dateEl = articleEl.querySelector('[data-post-date]');
    if (dateEl) dateEl.textContent = formatBlogDate(post.date);
    
    // Set tags
    const tagsEl = articleEl.querySelector('[data-post-tags]');
    if (tagsEl && Array.isArray(post.tags)) {
      tagsEl.innerHTML = '';
      post.tags.forEach(tag => {
        const badge = document.createElement('span');
        badge.className = 'badge bg-primary';
        badge.textContent = tag;
        tagsEl.appendChild(badge);
      });
    }
    
    // Set cover image
    const coverEl = articleEl.querySelector('[data-post-cover]');
    const coverImgEl = articleEl.querySelector('[data-post-cover-img]');
    if (post.cover && coverEl && coverImgEl) {
      coverImgEl.src = post.cover;
      coverImgEl.alt = post.title || '';
      coverEl.classList.remove('d-none');
    }
    
    // Set content
    const contentEl = articleEl.querySelector('[data-post-content]');
    if (contentEl && Array.isArray(post.content)) {
      contentEl.innerHTML = post.content.map(p => `<p>${p}</p>`).join('');
    }
    
    // Set gallery
    const galleryEl = articleEl.querySelector('[data-post-gallery]');
    if (galleryEl && Array.isArray(post.images) && post.images.length > 0) {
      galleryEl.innerHTML = '';
      post.images.forEach(image => {
        const col = document.createElement('div');
        col.className = 'col-md-6 col-lg-4';
        const img = document.createElement('img');
        img.className = 'img-fluid rounded enlargeable';
        img.src = image;
        img.alt = post.title || '';
        img.loading = 'lazy';
        col.appendChild(img);
        galleryEl.appendChild(col);
      });
      galleryEl.classList.remove('d-none');
    }
    
  } catch (error) {
    console.error('Error loading blog post:', error);
    // Could show an error in the article element if needed
  }
}

/**
 * Load and display the blog post list
 */
export async function loadBlogPostList() {
  const listEl = document.querySelector('[data-post-list]');
  const containerEl = document.querySelector('[data-post-list-container]');
  
  if (!listEl || !containerEl) return;
  
  try {
    const response = await fetch('/data/blog-posts.json');
    if (!response.ok) {
      throw new Error(`Failed to load blog posts: ${response.status}`);
    }
    
    const data = await response.json();
    const posts = data.posts || [];
    
    containerEl.innerHTML = '';
    
    posts.forEach(post => {
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4';
      
      const card = createBlogCard(post, {
        linkTarget: `/blog/?post=${post.id}`,
        showCover: true,
        showThumbs: true,
        maxThumbs: 3
      });
      
      col.appendChild(card);
      containerEl.appendChild(col);
    });
    
    // Show list
    listEl.classList.remove('d-none');
    
  } catch (error) {
    console.error('Error loading blog post list:', error);
  }
}

/**
 * Load and display the PD0DP feed
 */
export async function loadPD0DPFeed() {
  const feedListEl = document.querySelector('[data-feed-list]');
  const feedStatusEl = document.querySelector('[data-feed-status]');
  
  if (!feedListEl) return;
  
  try {
    const response = await fetch('/blog/sources/pd0dp-feed.xml');
    if (!response.ok) {
      throw new Error(`Failed to load feed: ${response.status}`);
    }
    
    const xmlText = await response.text();
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(xmlText, 'text/xml');
    
    const items = xmlDoc.querySelectorAll('item');
    feedListEl.innerHTML = '';
    
    items.forEach((item, index) => {
      if (index >= 6) return; // Limit to 6 items
      
      const title = item.querySelector('title')?.textContent || '';
      const link = item.querySelector('link')?.textContent || '';
      const pubDate = item.querySelector('pubDate')?.textContent || '';
      const description = item.querySelector('description')?.textContent || '';
      
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4';
      
      const card = document.createElement('div');
      card.className = 'card h-100';
      
      const cardBody = document.createElement('div');
      cardBody.className = 'card-body';
      
      const meta = document.createElement('p');
      meta.className = 'blog-meta mb-2';
      meta.textContent = formatBlogDate(pubDate);
      
      const titleLink = document.createElement('a');
      titleLink.className = 'fw-semibold blog-link stretched-link';
      titleLink.textContent = title;
      titleLink.href = link;
      titleLink.target = '_blank';
      titleLink.rel = 'noopener noreferrer';
      
      const excerpt = document.createElement('p');
      excerpt.className = 'text-muted mt-2 mb-0';
      excerpt.textContent = description.substring(0, 150) + '...';
      
      cardBody.appendChild(meta);
      cardBody.appendChild(titleLink);
      cardBody.appendChild(excerpt);
      card.appendChild(cardBody);
      col.appendChild(card);
      feedListEl.appendChild(col);
    });
    
  } catch (error) {
    console.error('Error loading PD0DP feed:', error);
    if (feedStatusEl) {
      feedStatusEl.classList.remove('d-none');
    }
  }
}
