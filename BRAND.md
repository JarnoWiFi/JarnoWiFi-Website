# JarnoWiFi — Brand guidelines

**"Signal"** — the corporate identity for JarnoWiFi. Everything here is
implemented as design tokens in `docs/site.css`; this document explains the
intent so future work stays consistent.

---

## 1. Positioning

JarnoWiFi is infrastructure, not a gadget. Events depend on it for payments,
safety and production. The identity should read the way the service behaves:
**precise, calm, and technical** — never loud, never playful.

| We are                   | We are not              |
| ------------------------ | ----------------------- |
| Engineered, measured     | Salesy, hyped           |
| Field-proven, hands-on   | Abstract, corporate     |
| Quietly premium          | Cheap, cluttered        |
| Specific and checkable   | Vague ("best-in-class") |

**Voice:** short declarative sentences. Say what is actually delivered and under
what conditions — "Starlink 200–300 Mbps + 5G; fiber where available" beats
"blazing-fast connectivity".

**Claims are a brand asset.** The site deliberately does not advertise uptime
percentages, a staffed NOC, guaranteed failover times or aggregate throughput,
because none of those are contractually backed today. `tools/check-content.py`
fails the build if any of them reappear in the copy catalog or the markup. If a
claim ever becomes real and contractual, remove it from `RETIRED_CLAIMS` in that
script deliberately — do not work around the check.

---

## 2. Logo

The mark is a signal radiating from a source, with the arcs **thickening as they
travel outward** — an inversion of the standard WiFi glyph that reads as signal
gaining strength rather than fading. The origin dot is amber: the source is
warm, the signal is cool.

| File                                  | Use                                              |
| ------------------------------------- | ------------------------------------------------ |
| `docs/assets/brand/mark.svg`          | Primary mark, on any background (self-contained tile) |
| `docs/assets/brand/mark-mono.svg`     | Single-colour use; inherits `currentColor`       |
| `docs/assets/brand/favicon.svg` / `.ico` | Browser tab                                   |
| `docs/assets/brand/icon-180/192/512.png` | Apple touch icon and PWA icons                |
| `docs/assets/brand/og.svg` / `og.jpg` | Social share card (1200×630)                     |

The SVGs are the sources. After editing `mark.svg` or `og.svg`, re-render the
rasters with `./tools/build-brand.sh` and commit the results.

**Lockup:** the mark at 32px, then "JarnoWiFi" in Space Grotesk 700 at
`-0.035em` tracking with a `0.6rem` gap. This is the `.navbar-brand` component,
which draws the mark via `::before` — do not rebuild it by hand.

**Rules**

- Minimum size 24px. Below that the third arc closes up; use `mark-mono.svg`.
- Clear space: at least the tile's corner radius on every side.
- Never recolour the arcs, rotate the mark, add effects, or place the tile on a
  busy photo without a scrim.
- The wordmark is one word, camel-cased: **JarnoWiFi**. Not "Jarno WiFi", not
  "JARNOWIFI".

---

## 3. Colour

Cyan is the only accent. Amber appears about once per screen — the logo dot, the
"most booked" plan badge, the backup-uplink label. If everything is highlighted,
nothing is.

### Brand palette

| Token           | Hex       | Use                                        |
| --------------- | --------- | ------------------------------------------ |
| `--jw-ink`      | `#060B14` | Deepest surface: hero, footer, page headers |
| `--jw-abyss`    | `#0B1420` | Dark surface, one step up                   |
| `--jw-slate`    | `#0F1826` | Panels on dark                              |
| `--jw-steel`    | `#17222F` | Raised elements on dark                     |
| `--jw-cyan-400` | `#22D3EE` | **Primary accent** on dark                  |
| `--jw-cyan-700` | `#0E7490` | Accent text on light (passes AA)            |
| `--jw-amber`    | `#FFB020` | Rare highlight only                         |
| `--jw-green`    | `#34D399` | Positive status                             |
| `--jw-paper-2`  | `#F4F7FA` | Alternating light section background        |
| `--jw-hairline` | `#DBE4ED` | Borders                                     |

### The contrast rule

`--jw-cyan-400` is **2.0:1 on white** and must never carry text there. Use the
semantic `--accent` token, which resolves to cyan-700 on light and cyan-300 on
dark, and the problem cannot occur.

### Semantic tokens

Build with these, never the raw hexes. They re-map under
`prefers-color-scheme: dark`:

`--bg` · `--bg-subtle` · `--surface` · `--surface-2` · `--line` · `--text` ·
`--text-muted` · `--text-faint` · `--accent` · `--accent-bright` ·
`--accent-wash` · `--accent-line`

Sections that are dark in **both** schemes (`.hero`, `.footer`, `.reliability`,
`.cta-band`, `.hero-video`) use the fixed `--dark-*` tokens instead.

---

## 4. Typography

| Role    | Family               | Weights | Notes                                     |
| ------- | -------------------- | ------- | ----------------------------------------- |
| Display | **Space Grotesk**    | 500–700 | Headings, prices, metrics. `-0.03em` tracking |
| Text    | **Inter** (variable) | 400–700 | Body, UI, labels                          |

Self-hosted from `docs/assets/fonts/`. Latin-ext is a separate subset behind
`unicode-range`, so most visitors download ~70 KB and never fetch it.

**Scale** — fluid `clamp()` tokens `--step--1` … `--step-5`. Never hard-code a
font size; use a token or a heading level.

**Rules**

- Prices and metrics use `font-variant-numeric: tabular-nums`.
- Headings use `text-wrap: balance`, body copy `text-wrap: pretty`.
- `.section-label` (tracked caps with a cyan rule) opens every section — one per
  section, always above the `<h2>`.

---

## 5. Layout & form

- **Container** 1200px, gutter `clamp(1.25rem, …, 2rem)`.
- **Radii** 6 / 10 / 14 / 20 / 28px plus pill. Cards `--r-lg`, panels and banners
  `--r-xl`, buttons always pills.
- **Elevation** is restrained: hairline border plus a soft shadow. On dark
  surfaces use the cyan `--glow` rather than a black shadow.
- The grid and utility classes mirror the Bootstrap names the templates already
  used (`.row`, `.col-lg-4`, `.g-4`, `.d-flex`, `.mb-3`…) so markup did not have
  to change. Block elements keep Reboot-compatible bottom margins — the
  templates depend on that rhythm.

### Recurring motifs

1. **Signal grid** — a 40–44px cyan grid, radially masked, on every dark
   surface. Echoes an RF site plan.
2. **Horizon glow** — a cyan bloom in the top-right of dark sections.
3. **Ascending weight** — the logo arcs, and the featured plan's top rule
   (cyan → cyan → amber).

---

## 6. Motion

Short and subtle. `--t-fast` 140ms, `--t` 220ms, `--t-slow` 420ms, easing
`cubic-bezier(0.16, 1, 0.3, 1)`.

- Cards lift 3px on hover; buttons press 1px.
- `.fade-up` with `.delay-1…7` staggers content in on load.
- Everything collapses under `prefers-reduced-motion: reduce`, and the hero
  video is never even downloaded.

---

## 7. Photography

Real deployments only — no stock. Cabling, masts, dishes, cases, laptops in
vans. On dark backgrounds always place a scrim before text. Run
`tools/build-images.py` after adding photos to generate the WebP derivatives.

---

## 8. Accessibility floor

- Body text ≥ 4.5:1; large text and UI borders ≥ 3:1.
- Focus is always visible: a 2px `--focus` ring at 2px offset. Never remove it.
- Every interactive control has an accessible name; decorative icons are
  `aria-hidden`.
- The site works with JavaScript disabled: navigation, language switching and
  all content are server-rendered.
