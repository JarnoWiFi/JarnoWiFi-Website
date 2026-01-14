<!doctype html>
<html lang="en">
  <head>
    <?php
      // Page-specific meta
      $metaTitle = 'Jobs — JarnoWiFi';
      // Use translated jobs lead as description via metaDescriptionKey
      $metaDescriptionKey = 'jobs.lead';
      // Use a stable image present in the repo
      $metaImage = '/img/people/jarno.jpeg';
    ?>
    <?php include 'partials/meta-common.php'; ?>
    <title>Jobs — JarnoWiFi</title>
  </head>
  <body>
    <div data-include="header" data-active="jobs"></div>

    <main class="page-shell">
      <section class="mb-5">
        <div class="container">
          <div class="hero-video">
            <div class="hero-video__overlay"></div>
            <div class="container hero-video__content">
              <div class="row justify-content-center mx-0">
                <div class="col-lg-9">
                  <p class="section-label mb-2" data-i18n="jobs.label">Jobs</p>
                  <h1 class="fw-bold mb-3" data-i18n="jobs.title"><span class="text-gradient">Help build reliable event connectivity</span></h1>
                  <p class="lead text-white-50 mb-0" data-i18n="jobs.lead">
                    We deploy managed WiFi for markets, camps, festivals and remote venues — powered by Starlink, 5G failover and disciplined operations.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <div class="card info-card p-4 mb-4">
              <h5 class="fw-semibold" data-i18n="jobs.overview.title">How we work</h5>
              <p class="text-muted mb-3" data-i18n="jobs.overview.body">
                JarnoWiFi operates small, fast teams on site. We care about uptime, clear communication, and clean deployments. If you like networks, hardware, and real-world constraints, you'll fit in.
              </p>
              <h6 class="fw-semibold" data-i18n="jobs.benefits.title">Benefits</h6>
              <ul class="text-muted mb-3">
                <li data-i18n="jobs.benefits.b1">Employee hosting for your own hardware (lab + test time)</li>
                <li data-i18n="jobs.benefits.b2">Free accommodation on multi-day deployments</li>
                <li data-i18n="jobs.benefits.b3">On-site access: take part in event programs while on duty</li>
                <li data-i18n="jobs.benefits.b4">Subsidies for rental cars on deployments (when needed)</li>
              </ul>
              <div class="d-flex flex-wrap gap-2">
                <span class="pill" data-i18n="jobs.pill1">On-site deployments</span>
                <span class="pill" data-i18n="jobs.pill2">Starlink + 5G redundancy</span>
                <span class="pill" data-i18n="jobs.pill3">Benelux + Germany</span>
                <span class="pill" data-i18n="jobs.pill4">Freelance</span>
              </div>
            </div>

            <div class="card job-card p-4 mb-4" id="field-engineer">
              <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                <div>
                  <h3 class="fw-bold mb-1" data-i18n="jobs.field.title">Freelance Field Engineer (Event WiFi)</h3>
                  <div class="text-muted" data-i18n="jobs.field.meta">On-site • Freelance • Weekends sometimes</div>
                </div>
                <a class="btn btn-sm cta-primary" href="mailto:jobs@jarnowifi.net?subject=Application%3A%20Freelance%20Field%20Engineer" data-i18n="jobs.apply">Apply via email</a>
              </div>
              <hr />
              <p class="text-muted" data-i18n="jobs.field.summary">
                You deploy and operate the on-site network stack: mounting APs, setting up routing/uplinks, verifying coverage, and keeping the event live.
              </p>

              <div class="row g-4">
                <div class="col-md-6">
                  <h6 class="fw-semibold" data-i18n="jobs.responsibilities">Responsibilities</h6>
                  <ul class="text-muted mb-0">
                    <li data-i18n="jobs.field.r1">Build AP layouts, mount hardware, run safe cabling, label and document.</li>
                    <li data-i18n="jobs.field.r2">Bring up WAN links (Starlink, 5G/LTE, fiber/cable when present) and verify failover.</li>
                    <li data-i18n="jobs.field.r3">Validate RF and client experience; tune channels, power, and QoS profiles.</li>
                    <li data-i18n="jobs.field.r4">Coordinate with organizers and vendors (POS, ticketing, livestream teams).</li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <h6 class="fw-semibold" data-i18n="jobs.requirements">Requirements</h6>
                  <ul class="text-muted mb-0">
                    <li data-i18n="jobs.field.req1">Hands-on networking basics: VLANs, DHCP/DNS, routing, troubleshooting.</li>
                    <li data-i18n="jobs.field.req2">Comfortable working outdoors and lifting/handling equipment safely.</li>
                    <li data-i18n="jobs.field.req3">Clear, calm communication under time pressure.</li>
                    <li data-i18n="jobs.field.req4">Driver's license and ability to travel in NL/DE/BE.</li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="card job-card p-4 mb-4" id="sales">
              <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                <div>
                  <h3 class="fw-bold mb-1" data-i18n="jobs.sales.title">Sales / Account (Event Connectivity)</h3>
                  <div class="text-muted" data-i18n="jobs.sales.meta">Remote • Freelance • Commission-based</div>
                </div>
                <a class="btn btn-sm cta-primary" href="mailto:jobs@jarnowifi.net?subject=Application%3A%20Sales%20%2F%20Account" data-i18n="jobs.apply">Apply via email</a>
              </div>
              <hr />
              <p class="text-muted" data-i18n="jobs.sales.summary">
                You help organizers and venues understand what they need, translate requirements into clear proposals, and keep communication sharp before and during an event.
              </p>
              <div class="row g-4">
                <div class="col-md-6">
                  <h6 class="fw-semibold" data-i18n="jobs.responsibilities">Responsibilities</h6>
                  <ul class="text-muted mb-0">
                    <li data-i18n="jobs.sales.r1">Qualify leads and collect requirements (date, venue, attendance, vendors).</li>
                    <li data-i18n="jobs.sales.r2">Coordinate pricing and scope with ops; write proposals and SLAs.</li>
                    <li data-i18n="jobs.sales.r3">Keep clients informed with simple, reliable timelines and expectations.</li>
                    <li data-i18n="jobs.sales.r4">Build long-term relationships with recurring events and venues.</li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <h6 class="fw-semibold" data-i18n="jobs.requirements">Requirements</h6>
                  <ul class="text-muted mb-0">
                    <li data-i18n="jobs.sales.req1">Experience in B2B sales or event production/operations.</li>
                    <li data-i18n="jobs.sales.req2">Able to explain technical topics clearly without jargon.</li>
                    <li data-i18n="jobs.sales.req3">Comfortable with customer calls and remote discovery sessions.</li>
                    <li data-i18n="jobs.sales.req4">Fluent German + English or Dutch + English required.</li>
                    <li data-i18n="jobs.sales.req5">Comfortable working with municipal tenders (RFPs) and procurement processes.</li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="card job-card p-4 mb-4" id="head-of-sales">
              <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                <div>
                  <h3 class="fw-bold mb-1" data-i18n="jobs.hos.title">Head of Sales (Event Connectivity)</h3>
                  <div class="text-muted" data-i18n="jobs.hos.meta">Remote • Freelance</div>
                </div>
                <a class="btn btn-sm btn-dark" href="mailto:jobs@jarnowifi.net?subject=Application%3A%20Head%20of%20Sales" data-i18n="jobs.apply">Apply via email</a>
              </div>
              <hr />
              <p class="text-muted" data-i18n="jobs.hos.summary">
                You own the full commercial pipeline: finding the right events, qualifying quickly, and turning requirements into clear, closeable proposals.
              </p>
              <div class="row g-4">
                <div class="col-md-6">
                  <h6 class="fw-semibold" data-i18n="jobs.responsibilities">Responsibilities</h6>
                  <ul class="text-muted mb-0">
                    <li data-i18n="jobs.hos.r1">Build and maintain a steady pipeline of events and venues.</li>
                    <li data-i18n="jobs.hos.r2">Run discovery calls, capture requirements, and propose the right scope.</li>
                    <li data-i18n="jobs.hos.r3">Own pricing, proposals, and handoff into operations.</li>
                    <li data-i18n="jobs.hos.r4">Create a simple sales cadence with clean CRM notes and forecasts.</li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <h6 class="fw-semibold" data-i18n="jobs.requirements">Requirements</h6>
                  <ul class="text-muted mb-0">
                    <li data-i18n="jobs.hos.req1">Proven B2B sales leadership or senior account experience.</li>
                    <li data-i18n="jobs.hos.req2">Strong writing: proposals that are clear and precise.</li>
                    <li data-i18n="jobs.hos.req3">Comfortable selling an ops-heavy, reliability-first service.</li>
                    <li data-i18n="jobs.hos.req4">Fluent German + English or Dutch + English required.</li>
                    <li data-i18n="jobs.hos.req5">Experience with municipal tenders (RFPs) and public procurement is a plus.</li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="card info-card p-4">
              <h5 class="fw-semibold" data-i18n="jobs.howto.title">How to apply</h5>
              <p class="text-muted mb-2" data-i18n="jobs.howto.body1">
                Email us with a short intro, your location, availability, and relevant experience.
              </p>
              <p class="text-muted mb-0" data-i18n="jobs.howto.body2">
                For engineers: include your comfort level with WiFi/RF, routing/VLANs, and on-site work.
              </p>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?php include 'partials/footer.php'; ?>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script type="module">
      import { i18n } from '/js/i18n.js';
      
      document.addEventListener('DOMContentLoaded', async () => {
        await import('/menu.js');
        await i18n.init();
        await window.loadHeader({ active: 'jobs' });
        await window.loadFooter();
      });
    </script>
  </body>
</html>
