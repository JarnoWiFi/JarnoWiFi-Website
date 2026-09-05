# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Multilingual (nl/en/de) marketing website for JarnoWiFi, an event WiFi service. Plain PHP 8.2 + vanilla JS + custom CSS — **no build step, no package manager, no tests, no linter**. `docs/` is the public web root.

## Commands

```bash
# One-time setup: contact form needs an SMTP password
echo "SMTP_PASS=your_smtp_password" > .env

# Run locally (nginx on http://localhost:1212, redirects to /nl/, /en/, or /de/)
docker compose up -d
docker compose down
```

`docs/` is volume-mounted read-only into both containers, so PHP/JS/CSS edits are live on refresh. Changes to `nginx.conf` or `docker-compose.yml` require `docker compose down && docker compose up -d`.

**Pushing to `main` deploys to production immediately** — GitHub Actions rsyncs the repo to the server and restarts the containers (`.github/workflows/deploy.yml`).

## Architecture

Two containers (docker-compose.yml): `nginx:alpine` serving static files and `php:8.2-fpm-alpine` executing PHP. There is no PHP router — **all URL routing lives in `nginx.conf`**, which rewrites language-prefixed URLs (`/en/jobs`) to unprefixed PHP files (`/jobs.php`). Adding a page therefore takes three pieces: the `docs/*.php` file, a rewrite rule for `/(en|de|nl)/<page>`, and a bare-path redirect (`/​<page>` → detected language). Nginx picks the language from the `preferredLanguage` cookie, falling back to `Accept-Language`, defaulting to `nl`.

### Page skeleton

Every page follows the same pattern (see `docs/jobs.php` for a small example):

1. Set `$metaTitle` / `$metaDescriptionKey`, then `include 'partials/meta-common.php'` in `<head>`.
2. Body contains `<div data-include="header" data-active="<navkey>">` — the header/footer are **injected client-side**, not PHP-included.
3. A `<script type="module">` at the bottom imports `i18n` from `/js/i18n.js`, dynamically imports `/menu.js`, then calls `i18n.init()`, `window.loadHeader({active})`, `window.loadFooter()`.
4. `include 'partials/footer.php'` and `partials/modal.php` at the end of body.

Note: `docs/menu.js` is the live module (loads `partials/header.html` / `footer.php`, wires the language switcher). `docs/js/menu.js` is an unused legacy copy — don't edit it.

### i18n (two layers)

- **Server-side** (`partials/meta-common.php`): parses the language from `$_SERVER['REQUEST_URI']`, loads `docs/locales/translations.json`, and exposes `t($key, $fallback)` for meta/SEO tags. It also writes the language into `localStorage` and the `preferredLanguage` cookie so nginx and the client agree.
- **Client-side** (`docs/js/i18n.js`, `I18nManager`): after load, replaces the text of every element carrying a `data-i18n="dot.path.key"` attribute. Language priority: URL path > localStorage > browser > `nl`.

The hardcoded text inside the PHP files is Dutch and acts as the fallback. Any user-visible string needs a `data-i18n` attribute plus keys under all three top-level language objects (`nl`, `en`, `de`) in `translations.json` — a missing key silently leaves the Dutch text in place.

### Blog

Fully client-rendered by `docs/js/blog-helpers.js`. Posts live in `docs/data/blog-posts.json` (slug, title, date, tags, cover, HTML `content`, optional `gallery`). `docs/blog/index.php` shows the post list, or a single post when `?post=<slug>` is present. It also renders an external RSS feed from the static file `docs/blog/sources/pd0dp-feed.xml`. The homepage reuses `loadBlogPosts()` for its blog section.

### Contact form

`docs/contact.php` is a self-contained endpoint with a hand-rolled raw-socket SMTP client (no Composer/PHPMailer). Only `SMTP_PASS` (required, from `.env` via docker-compose) and `SMTP_HELO` come from the environment; SMTP host, sender, and recipient are hardcoded near the bottom of the file. Spam protection is a honeypot field named `website`. Responses are JSON when the client sends `Accept: application/json` / `X-Requested-With`, plain text otherwise.
