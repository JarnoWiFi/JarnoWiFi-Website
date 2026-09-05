# JarnoWiFi website

Marketing site for JarnoWiFi — managed WiFi for markets, summer camps, festivals
and other outdoor events, built on Starlink with 5G backup.

Three languages (Dutch, English, German), served by nginx + PHP-FPM in Docker.

## Architecture

Copy is **rendered server-side from a single catalog** (`docs/locales/translations.json`).
Pages never hardcode visible text; they call `t('key')` / `te('key')`. This matters:
the site previously kept every string twice — once in the PHP and once in the
catalog — and the two had drifted apart on 215 of ~361 keys, so prices visibly
changed after JavaScript loaded. `tools/check-content.py` now fails the build if
copy starts creeping back into markup.

There is **no CSS or JS framework**. `docs/site.css` holds the entire design
system and `docs/js/site.js` (~3 KB gzipped) holds all behaviour: nav collapse,
language dropdown, FAQ accordion, lightbox, contact form, cookie consent and the
gated hero video. Navigation, translations, the FAQ and blog content all work
with JavaScript disabled. Dropping Bootstrap and Google Fonts removed roughly
50 KB gzipped and two third-party origins, which also let the CSP drop
`cdn.jsdelivr.net`, `fonts.googleapis.com` and `fonts.gstatic.com`.

```
docs/                       # web root
├── index.php               # homepage
├── reliability.php         # reliability / service scope
├── jobs.php                # open roles
├── imprint.php             # Impressum
├── privacy.php             # privacy statement
├── contact.php             # contact form handler (SMTP)
├── sitemap.php             # served at /sitemap.xml
├── blog/index.php          # blog list + single post
├── partials/
│   ├── i18n-boot.php       # language detection + t()/e()/te()/langUrl() helpers
│   ├── meta-common.php     # <head>: SEO, OG, hreflang, JSON-LD, consent-gated GA
│   ├── header.php          # nav (server-rendered)
│   ├── footer.php
│   ├── blog.php            # post loading + rendering
│   ├── modal.php           # lightbox dialog
│   ├── consent.php         # cookie banner
│   └── scripts.php
├── assets/
│   ├── brand/              # logo, favicons, PWA icons, OG card
│   └── fonts/              # self-hosted Inter + Space Grotesk (woff2)
├── site.css                # the entire design system — see BRAND.md
├── locales/translations.json  # ALL visible copy, 3 locales
├── data/blog-posts.json       # blog content
├── js/site.js                 # progressive enhancement
├── js/analytics.js            # loaded only after consent
└── img/opt/                   # generated responsive derivatives (see tools/)
tools/
├── build-images.py         # regenerate img/opt/ derivatives
├── check-content.py        # locale parity, retired claims, no inline copy
└── smoke-test.py           # end-to-end HTTP checks
```

## Local development

```bash
cp .env.example .env        # set SMTP_PASS (any value works for local browsing)
docker compose up -d --wait
```

Open http://localhost:1212 — it redirects to a language path (`/nl/`, `/en/`, `/de/`)
based on the `preferredLanguage` cookie, then `Accept-Language`.

```bash
docker compose down
```

## Routing

nginx maps language-prefixed URLs onto the PHP files:

| URL | File |
|---|---|
| `/<lang>/` | `index.php` |
| `/<lang>/jobs`, `/reliability`, `/imprint`, `/privacy` | matching `*.php` |
| `/<lang>/blog` | `blog/index.php` (list) |
| `/<lang>/blog/<slug>` | `blog/index.php` (single post) |
| `/sitemap.xml` | `sitemap.php` |

The language-prefixed rules deliberately sit **before** the generic `\.php$`
handler: the contact form posts to `/contact.php` from a page served under
`/<lang>/`, and that used to fall through to a 404 that silently dropped leads.

`/partials/` and `/locales/` are `internal` — they are templates and data, not pages.

## Internationalisation

- All copy lives in `docs/locales/translations.json` under `nl`, `en`, `de`.
- `docs/partials/i18n-boot.php` derives `$currentLang` from the URL prefix and
  exposes `t()` (translate), `e()` (escape), `te()` (translate + escape) and
  `langUrl()`.
- Adding a key means adding it to **all three** locales; CI enforces parity.
- The language switcher is a plain set of links to the same page under a
  different prefix, so it works without JavaScript.

## Contact form

`docs/contact.php` sends via SMTP. It sets `Reply-To` to the submitter so replies
reach the lead. Protections: honeypot field, length caps, per-IP application
throttle (5/hour) plus an nginx `limit_req` zone.

Responses never include SMTP configuration or server dialogue — failures are
written to the PHP error log and the client receives a generic message only.

Configuration is environment-driven (see `.env.example`): `SMTP_HOST`, `SMTP_PORT`,
`SMTP_USER`, `SMTP_PASS`, `SMTP_FROM`, `SMTP_HELO`, `SMTP_TLS`, `CONTACT_RECIPIENT`,
`SITE_ORIGIN`. Only these are exposed to PHP (`php-fpm-env.conf` sets
`clear_env = yes`), so the rest of the process environment stays out of reach.

## Privacy

Google Analytics is **not loaded at all** until the visitor accepts via the
consent banner; the server withholds the tag entirely. Consent is stored in the
`analyticsConsent` cookie and can be withdrawn on `/privacy`. The only
consent-free cookie is `preferredLanguage`.

## Images

Sources live in `docs/img/`; the site references generated derivatives in
`docs/img/opt/`. After adding or replacing a source image:

```bash
python3 tools/build-images.py
```

The hero background video is decorative and ~1.8 MB. The poster image always
renders; the video is only fetched on wide viewports, on a connection that does
not report save-data or 2g, and when the visitor has not requested reduced
motion. (Hiding it with CSS would not have prevented the download.)

## Checks

```bash
python3 tools/check-content.py                 # locale parity, retired claims, no inline copy
find docs -name '*.php' -print0 | xargs -0 -n1 php -l
docker compose up -d --wait && python3 tools/smoke-test.py
```

CI (`.github/workflows/ci.yml`) runs all of these on every pull request, plus
nginx and compose validation and a gitleaks secret scan. The scan invokes the
gitleaks binary directly rather than `gitleaks-action`, which requires a paid
licence on organisation-owned repositories.

## Deployment

Pushing to `main` triggers `.github/workflows/deploy.yml`: rsync the repo to the
server, then restart the containers.

```
rsync -az --delete --exclude ".git" ./ root@krakatau.treudler.net:/root/docker/jarnowifi/website/
ssh root@krakatau.treudler.net "cd /root/docker/jarnowifi/website && docker compose down && docker compose up -d"
```

Required repository secrets: `SSH_PRIVATE_KEY`, `SMTP_PASS`.

The workflow writes `.env` containing `SMTP_PASS` before syncing. Every other
setting has a default in `docker-compose.yml`, including
`SITE_ORIGIN=https://jarnowifi.net`, which drives canonical, OG and hreflang
URLs — override it in `.env` on the server if the public origin ever changes.

The container publishes port `1212` on all interfaces; the reverse proxy in
front terminates TLS and should set `X-Forwarded-Proto` so generated URLs use
`https://`.

## Design system

The visual identity is **"Signal"** — deep navy, a single electric-cyan accent
and a rare amber highlight. Logo, palette, type scale, motion and the
accessibility floor are documented in **[BRAND.md](BRAND.md)**.

`docs/site.css` is the whole presentation layer: ~44 KB, no framework. It
carries the design tokens, a small grid/utility layer matching the class names
the templates use, and every component. There is no build step.

Build against the semantic tokens, not the raw brand hexes — they re-map
automatically under `prefers-color-scheme: dark`:

```css
--bg  --bg-subtle  --surface  --surface-2  --line
--text  --text-muted  --text-faint
--accent  --accent-bright  --accent-wash  --accent-line
```

`--accent` resolves to cyan-700 on light backgrounds and cyan-300 on dark, so
accent text always clears WCAG AA. Raw `--jw-cyan-400` is 2.0:1 on white and
must never carry text.

Sections that stay dark in both schemes (hero, footer, `.reliability`) use the
fixed `--dark-*` tokens instead.

### Fonts

Space Grotesk (display) and Inter (body) are **self-hosted** from
`docs/assets/fonts/` as subset woff2 — no Google Fonts request, which is faster
and avoids sending visitor IPs to a third party. Latin-ext is split behind
`unicode-range`, so a typical visitor downloads ~70 KB.

### Brand assets

`docs/assets/brand/` holds the mark, favicons, PWA icons and the social card.
The SVGs are the sources; `./tools/build-brand.sh` re-renders the rasters
(favicons, PWA icons, `og.jpg`) in a container.

## Licence

Copyright © 2026 Jarno Sulmann, trading as JarnoWiFi. All rights reserved.
