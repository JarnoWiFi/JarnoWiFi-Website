<!doctype html>
<html lang="en">
  <head>
    <?php
      $metaTitle = 'Reliability — JarnoWiFi';
      $metaDescriptionKey = 'reliabilityPage.lead';
      $metaImage = '/img/people/jarno.jpeg';
    ?>
    <?php include 'partials/meta-common.php'; ?>
    <title>Reliability — JarnoWiFi</title>
  </head>
  <body>
    <div data-include="header" data-active="reliability"></div>

    <main class="page-shell">
      <section class="mb-5">
        <div class="container">
          <div class="hero-video">
            <div class="hero-video__overlay"></div>
            <div class="container hero-video__content">
              <div class="row align-items-center mx-0">
                <div class="col-lg-8">
                  <p class="section-label mb-2" data-i18n="reliabilityPage.label">Reliability</p>
                  <h1 class="fw-bold mb-3" data-i18n="reliabilityPage.title"><span class="text-gradient">Always-on connectivity for critical events</span></h1>
                  <p class="lead text-white-50 mb-4" data-i18n="reliabilityPage.lead">
                    Dual Starlink, bonded 5G, conditioned power, and on-call engineers working from tested runbooks to protect payments, production and safety.
                  </p>
                  <div class="d-flex flex-wrap gap-3">
                    <span class="fw-bold align-self-center" data-i18n="reliabilityPage.sla.table.incidentValue">"Binnen 5 minuten"</span>
                    <a class="btn btn-sm cta-primary" href="/#pricing" data-i18n="reliabilityPage.ctaSecondary">See managed plans</a>
                  </div>
                  <div class="d-flex flex-wrap gap-2 mt-4">
                    <span class="metric-pill" data-i18n="reliabilityPage.sla.table.fieldValue">"Binnen 60 minuten on-site"</span>
                    <span class="metric-pill" data-i18n="reliabilityPage.failover">Sub-2s failover</span>
                    <span class="metric-pill" data-i18n="reliabilityPage.power">3-layer power</span>
                    <span class="metric-pill" data-i18n="reliabilityPage.noc">24/7 NOC</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="container mb-5">
        <div class="row g-4">
          <div class="col-md-3">
            <div class="info-card p-3 h-100">
              <p class="text-muted mb-1" data-i18n="reliabilityPage.metrics.slaLabel">Availability</p>
              <h4 class="fw-bold mb-2" data-i18n="reliabilityPage.metrics.slaValue">99.98% SLA</h4>
              <p class="small text-muted mb-0" data-i18n="reliabilityPage.metrics.slaNote">Measured on managed WiFi + uplink bundle.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-card p-3 h-100">
              <p class="text-muted mb-1" data-i18n="reliabilityPage.metrics.failoverLabel">Failover</p>
              <h4 class="fw-bold mb-2" data-i18n="reliabilityPage.metrics.failoverValue">Under 2s L3 swap</h4>
              <p class="small text-muted mb-0" data-i18n="reliabilityPage.metrics.failoverNote">Automatic cutover between Starlink and 5G.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-card p-3 h-100">
              <p class="text-muted mb-1" data-i18n="reliabilityPage.metrics.powerLabel">Power</p>
              <h4 class="fw-bold mb-2" data-i18n="reliabilityPage.metrics.powerValue">3-layer</h4>
              <p class="small text-muted mb-0" data-i18n="reliabilityPage.metrics.powerNote">Grid, UPS banks, and generator-ready feeds.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-card p-3 h-100">
              <p class="text-muted mb-1" data-i18n="reliabilityPage.metrics.nocLabel">Monitoring</p>
              <h4 class="fw-bold mb-2" data-i18n="reliabilityPage.metrics.nocValue">24/7 NOC</h4>
              <p class="small text-muted mb-0" data-i18n="reliabilityPage.metrics.nocNote">Synthetic tests, telemetry, and alerting.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="container mb-5">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="reliabilityPage.pillars.label">Approach</p>
            <h2 class="fw-bold" data-i18n="reliabilityPage.pillars.title">Reliability built on redundancy, visibility, and discipline.</h2>
            <p class="text-muted" data-i18n="reliabilityPage.pillars.lead">Each layer is tested on-site before go-live and monitored continuously during the event.</p>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="pillar-card p-4">
              <h5 class="fw-semibold" data-i18n="reliabilityPage.pillars.uplinks.title">Resilient uplinks</h5>
              <ul class="text-muted mb-0 check-list">
                <li data-i18n="reliabilityPage.pillars.uplinks.item1">Dual Starlink with bonded routing.</li>
                <li data-i18n="reliabilityPage.pillars.uplinks.item2">5G/LTE with priority SIMs.</li>
                <li data-i18n="reliabilityPage.pillars.uplinks.item3">Wired uplink preferred when available.</li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="pillar-card p-4">
              <h5 class="fw-semibold" data-i18n="reliabilityPage.pillars.power.title">Conditioned power</h5>
              <ul class="text-muted mb-0 check-list">
                <li data-i18n="reliabilityPage.pillars.power.item1">UPS banks on core + edge.</li>
                <li data-i18n="reliabilityPage.pillars.power.item2">Generator-ready cabling and ATS.</li>
                <li data-i18n="reliabilityPage.pillars.power.item3">Voltage and temperature telemetry.</li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="pillar-card p-4">
              <h5 class="fw-semibold" data-i18n="reliabilityPage.pillars.monitoring.title">Monitoring</h5>
              <ul class="text-muted mb-0 check-list">
                <li data-i18n="reliabilityPage.pillars.monitoring.item1">Synthetic reachability checks every 30s.</li>
                <li data-i18n="reliabilityPage.pillars.monitoring.item2">QoS and latency per SSID/VLAN.</li>
                <li data-i18n="reliabilityPage.pillars.monitoring.item3">On-call escalation within minutes.</li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="pillar-card p-4">
              <h5 class="fw-semibold" data-i18n="reliabilityPage.pillars.runbooks.title">Runbooks</h5>
              <ul class="text-muted mb-0 check-list">
                <li data-i18n="reliabilityPage.pillars.runbooks.item1">Pre-flight checklists on-site.</li>
                <li data-i18n="reliabilityPage.pillars.runbooks.item2">Drills for uplink and power failover.</li>
                <li data-i18n="reliabilityPage.pillars.runbooks.item3">Post-incident review within 48h.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="container mb-5">
        <div class="row align-items-center g-4">
          <div class="col-lg-6">
            <div class="info-card p-4 h-100">
              <p class="section-label mb-2" data-i18n="reliabilityPage.sla.label">Service scope</p>
              <h3 class="fw-bold mb-3" data-i18n="reliabilityPage.sla.title">What our 99.98% SLA covers</h3>
              <ul class="text-muted mb-0 check-list">
                <li data-i18n="reliabilityPage.sla.item1">Managed WiFi SSIDs (guest, staff, production) and wired drops.</li>
                <li data-i18n="reliabilityPage.sla.item2">Primary + secondary uplinks with automatic failover.</li>
                <li data-i18n="reliabilityPage.sla.item3">Power delivery to core networking racks.</li>
                <li data-i18n="reliabilityPage.sla.item4">Live monitoring, alerting, and on-call response.</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-card p-4 h-100">
              <p class="section-label mb-2" data-i18n="reliabilityPage.sla.matrixLabel">Response targets</p>
              <div class="table-responsive">
                <table class="table align-middle mb-0">
                  <thead>
                    <tr>
                      <th scope="col" data-i18n="reliabilityPage.sla.table.col1">Event</th>
                      <th scope="col" data-i18n="reliabilityPage.sla.table.col2">Target</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td data-i18n="reliabilityPage.sla.table.failover">Uplink failover</td>
                      <td data-i18n="reliabilityPage.sla.table.failoverValue">Under 2 seconds</td>
                    </tr>
                    <tr>
                      <td data-i18n="reliabilityPage.sla.table.incident">Critical incident ack</td>
                      <td data-i18n="reliabilityPage.sla.table.incidentValue">Under 5 minutes</td>
                    </tr>
                    <tr>
                      <td data-i18n="reliabilityPage.sla.table.field">Field dispatch (event hours)</td>
                      <td data-i18n="reliabilityPage.sla.table.fieldValue">Under 60 minutes on-site</td>
                    </tr>
                    <tr>
                      <td data-i18n="reliabilityPage.sla.table.update">Status update cadence</td>
                      <td data-i18n="reliabilityPage.sla.table.updateValue">Every 15 minutes</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <p class="small text-muted mb-0 mt-3" data-i18n="reliabilityPage.sla.footer">Detailed SLAs and scopes are finalized per event.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="container mb-5">
        <div class="info-card p-4">
          <div class="row g-4 align-items-center">
            <div class="col-lg-6">
              <p class="section-label mb-2" data-i18n="reliabilityPage.runbook.label">Playbook</p>
              <h3 class="fw-bold mb-3" data-i18n="reliabilityPage.runbook.title">How we keep your network live</h3>
              <ol class="text-muted mb-0">
                <li data-i18n="reliabilityPage.runbook.step1">Site survey: uplink mapping, power paths, RF plan.</li>
                <li data-i18n="reliabilityPage.runbook.step2">Pre-flight: burn-in test of uplinks, UPS load test, failover drill.</li>
                <li data-i18n="reliabilityPage.runbook.step3">Go-live: staged activation of SSIDs and VLANs with validation walks.</li>
                <li data-i18n="reliabilityPage.runbook.step4">During event: continuous telemetry, synthetic tests, and staffed hotline.</li>
                <li data-i18n="reliabilityPage.runbook.step5">After action: report with uptime, incidents, and recommendations.</li>
              </ol>
            </div>
            <div class="col-lg-6">
              <div class="cta-band cta-band--dark h-100">
                <h4 class="fw-semibold" data-i18n="reliabilityPage.ctaBand.title">Need a reliability audit for your venue?</h4>
                <p class="mb-4" data-i18n="reliabilityPage.ctaBand.lead">We design the uplink, power and WiFi plan and deliver a ready-to-run kit with on-site engineers.</p>
                <div class="d-flex flex-wrap gap-3">
                  <a class="btn btn-sm cta-primary" href="/#contact" data-i18n="reliabilityPage.ctaBand.primary">Book a call</a>
                  <a class="btn btn-sm cta-outline" href="mailto:contact@jarnowifi.net" data-i18n="reliabilityPage.ctaBand.secondary">Email the NOC</a>
                </div>
              </div>
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
        await window.loadHeader({ active: 'reliability' });
        await window.loadFooter();
      });
    </script>
  </body>
</html>
