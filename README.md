# JarnoWiFi - Professional Event WiFi Solutions

JarnoWiFi delivers enterprise-grade WiFi infrastructure for markets, summer camps, festivals, and outdoor events. Built on Starlink satellite internet with 5G failover, backed by a 99.98% SLA.

## 🚀 Overview

This repository contains the JarnoWiFi website - a multilingual (Dutch, English, German) marketing site showcasing professional event WiFi services. The site features:

- **Multi-language support** with client-side i18n (nl, en, de)
- **Dynamic blog system** with RSS feed integration
- **Contact form** with SMTP integration
- **Responsive design** with custom CSS and Bootstrap 5
- **Dockerized deployment** with Nginx + PHP-FPM

## 🏗️ Architecture

### Tech Stack

- **Frontend**: HTML, CSS (custom design system), Vanilla JavaScript
- **Backend**: PHP 8.2 (for contact form and server-side rendering)
- **Web Server**: Nginx (Alpine)
- **Container Runtime**: Docker Compose
- **CI/CD**: GitHub Actions (automated deployment)

### Project Structure

```
PiloWiFi/
├── docs/                    # Public web root
│   ├── index.php           # Homepage
│   ├── contact.php         # Contact form handler
│   ├── imprint.php         # Legal impressum page
│   ├── jobs.php            # Careers page
│   ├── reliability.php     # Uptime & SLA page
│   ├── site.css            # Main stylesheet
│   ├── menu.js             # Navigation logic
│   ├── blog/               # Blog system
│   │   ├── index.php       # Blog post viewer
│   │   └── sources/        # RSS feeds
│   ├── data/               # Static data files
│   │   └── blog-posts.json
│   ├── img/                # Image assets
│   ├── js/                 # JavaScript modules
│   │   ├── i18n.js         # Internationalization engine
│   │   ├── blog-helpers.js # Blog rendering utilities
│   │   └── menu.js         # Menu functionality
│   ├── locales/            # Translation files
│   │   └── translations.json
│   └── partials/           # Reusable components
│       ├── header.html     # Site header
│       ├── footer.php      # Site footer
│       ├── meta-common.php # SEO & meta tags
│       └── modal.php       # Modal dialogs
├── docker-compose.yml      # Container orchestration
├── nginx.conf              # Nginx configuration with language routing
├── php-fpm-env.conf        # PHP-FPM environment config
└── README.md               # This file
```

## 🛠️ Getting Started

### Prerequisites

- Docker & Docker Compose
- SMTP credentials (for contact form functionality)

### Local Development

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd PiloWiFi
   ```

2. **Create environment file**
   ```bash
   echo "SMTP_PASS=your_smtp_password" > .env
   ```

3. **Start the containers**
   ```bash
   docker compose up -d
   ```

4. **Access the site**
   Open http://localhost:1212 in your browser

   The site will automatically redirect to a language-specific path:
   - http://localhost:1212/nl/ (Dutch)
   - http://localhost:1212/en/ (English)
   - http://localhost:1212/de/ (German)

### Stop the Development Server

```bash
docker compose down
```

## 🌍 Internationalization (i18n)

The site uses a custom client-side i18n system:

- **Translations**: Stored in `docs/locales/translations.json`
- **Language Detection**: 
  1. Cookie preference (`preferredLanguage`)
  2. URL path (`/en/`, `/de/`, `/nl/`)
  3. Browser `Accept-Language` header
- **Routing**: Nginx handles language prefix routing (see `nginx.conf`)

### Adding a New Language

1. Add language code to `docs/js/i18n.js` `supportedLanguages` array
2. Add translations to `docs/locales/translations.json`
3. Update Nginx language detection in `nginx.conf`

## 📧 Contact Form

The contact form (`docs/contact.php`) features:

- **SMTP Integration**: Sends emails via authenticated SMTP
- **Field Validation**: Server-side validation for all inputs
- **Anti-Spam**: Honeypot field and rate limiting
- **JSON API**: Supports both HTML and JSON responses
- **Security**: Input sanitization and CSRF protection

### Required Environment Variables

- `SMTP_PASS`: SMTP server password (set in `.env` file)

## 🚢 Deployment

Automated deployment via GitHub Actions on push to `main` branch:

1. **Build**: Prepares environment file with secrets
2. **Sync**: Uses rsync to deploy to production server
3. **Deploy**: Restarts Docker containers on remote server

### Manual Deployment

```bash
# SSH into production server
ssh root@krakatau.treudler.net

# Navigate to project directory
cd /root/docker/jarnowifi/website

# Pull latest changes
git pull origin main

# Restart containers
docker compose down && docker compose up -d
```

## 🎨 Design System

Custom CSS variables defined in `docs/site.css`:

```css
:root {
  --ink: #0f172a;      /* Primary text */
  --night: #020617;    /* Dark backgrounds */
  --ocean: #1e293b;    /* Medium dark */
  --sand: #f8fafc;     /* Light backgrounds */
  --sun: #f59e0b;      /* Accent (amber) */
  --teal: #0ea5e9;     /* Links & CTA */
  --mist: #e2e8f0;     /* Borders */
}
```

### Key Components

- **Glass Cards**: Translucent cards with backdrop blur
- **Hero Section**: Video background with gradient overlay
- **Service Cards**: Interactive hover effects with image galleries
- **Plan Cards**: Pricing cards with featured state
- **Stat Chips**: Pill-shaped badges for metrics

## 📝 Blog System

Dynamic blog with:

- **Markdown-style content** rendered from JSON
- **RSS feed integration** (PD0DP feed)
- **Image galleries** with lightbox support
- **Post filtering** by tags
- **SEO-friendly URLs** with post slugs

### Adding a Blog Post

Edit `docs/data/blog-posts.json`:

```json
{
  "slug": "post-slug",
  "title": "Post Title",
  "date": "2026-01-14",
  "tags": ["Technology", "WiFi"],
  "cover": "/img/cover.jpg",
  "content": "Post content in HTML",
  "gallery": ["/img/1.jpg", "/img/2.jpg"]
}
```

## 🔒 Security

- **Environment Variables**: Sensitive data stored in `.env` (not in repo)
- **Input Validation**: Server-side validation on all forms
- **XSS Prevention**: Output escaping in PHP templates
- **HTTPS**: Enforced in production (Nginx configuration)
- **Secrets Management**: GitHub Secrets for CI/CD

## 📊 Monitoring & Operations

- **24/7 NOC**: noc@jarnowifi.net
- **SLA**: 99.98% uptime guarantee
- **Infrastructure**: Dual Starlink + 5G failover
- **Support**: On-site and remote technical support

## 🤝 Contributing

Contact form submissions and inquiries:
- **General**: contact@jarnowifi.net
- **Jobs**: jobs@jarnowifi.net
- **Technical**: noc@jarnowifi.net

## 📄 License

Copyright © 2026 Jarno Sulmann trading as JarnoWiFi. All rights reserved.

## 🔗 Links

- **Website**: https://jarnowifi.net
- **Imprint**: https://jarnowifi.net/imprint
- **Careers**: https://jarnowifi.net/jobs

---

**Built with** ❤️ **by the JarnoWiFi team**