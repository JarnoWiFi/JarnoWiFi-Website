<!doctype html>
<html lang="nl">
  <head>
    <?php
      $metaTitle = 'JarnoWiFi — Professionele event-wifi overal';
      $metaDescriptionKey = 'hero.lead';
      $metaImage = '/img/people/jarno.jpeg';
    ?>
    <?php include 'partials/meta-common.php'; ?>
    <title>JarnoWiFi — Professionele event-wifi overal</title>
  </head>
  <body>
    <div data-include="header" data-active="home"></div>

    <section class="hero text-white" id="home">
      <video class="hero-bg-video" autoplay muted loop playsinline preload="metadata" aria-hidden="true">
        <source src="/img/background-video-1-webbg-20fps-420p.mp4" type="video/mp4" />
      </video>
      <div class="container hero-content">
        <div class="row align-items-center g-5">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="hero.label">Zakelijke connectiviteit</p>
            <h1 class="display-4 fw-bold mb-3 fade-up" data-i18n="hero.title"><span class="text-gradient">Professionele wifi-oplossingen overal.</span></h1>
            <p class="lead fade-up delay-1" data-i18n="hero.lead">
              JarnoWiFi levert professionele wifi voor markten, zomerkampen en festivals met satellietinternet via Starlink en 5G-back-up, ondersteund door een 99,98%-SLA.
            </p>
            <div class="d-flex flex-wrap gap-3 fade-up delay-2">
              <a class="btn btn-lg cta-primary" href="#contact" data-i18n="hero.ctaPrimary">Offerte aanvragen</a>
              <a class="btn btn-lg cta-outline" href="/reliability" data-i18n="hero.ctaSecondary">Bekijk onze uptime-aanpak</a>
            </div>
            <div class="d-flex flex-wrap gap-3 mt-4">
              <span class="stat-chip" data-i18n="hero.stat1">99,98% SLA</span>
              <span class="stat-chip" data-i18n="hero.stat2">Twee Starlink-schotels</span>
              <span class="stat-chip" data-i18n="hero.stat3">5G-failover</span>
              <span class="stat-chip" data-i18n="hero.stat4">24/7 NOC</span>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="glass-card p-4 floating">
              <h5 class="fw-semibold" data-i18n="hero.snapshot.title">Dekkingsoverzicht</h5>
              <p class="text-white-50 mb-4" data-i18n="hero.snapshot.desc">Voorbeeldopstelling voor een landelijk festival met 2.000 gasten.</p>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span data-i18n="hero.snapshot.capacity">Gastcapaciteit</span>
                <span class="fw-semibold" data-i18n="hero.snapshot.capacityValue">Tot 5.000 in de piek, afhankelijk van uplink</span>
              </div>
              <div class="d-flex flex-column align-items-start gap-1 mb-3">
                <span data-i18n="hero.snapshot.throughput">Totale capaciteit</span>
                <span class="fw-semibold" data-i18n="hero.snapshot.throughputValue">10+ Gbps met glasvezel en Starlink + 5G</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span data-i18n="hero.snapshot.setup">Opbouwtijd</span>
                <span class="fw-semibold" data-i18n="hero.snapshot.setupValue">6 uur</span>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <span data-i18n="hero.snapshot.support">Support</span>
                <span class="fw-semibold" data-i18n="hero.snapshot.supportValue">Op locatie + remote</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5 pattern-bg" id="services">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-8">
            <p class="section-label" data-i18n="services.label">Diensten</p>
            <h2 class="fw-bold" data-i18n="services.title">WiFi voor events met hoge eisen.</h2>
            <p class="text-muted" data-i18n="services.lead">
              We ontwerpen, leveren en beheren een complete connectiviteitsstack zodat je eventteams zich kunnen
              focussen op de ervaring.
            </p>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-1">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="services.card1.title">Event-wifi</h5>
                <p class="text-muted" data-i18n="services.card1.body">Premium gastnetwerken met captive portals, bandbreedtebeheer en live monitoring.</p>
                <div class="service-thumbs mt-3" aria-label="Example photos">
                  <img src="/img/20240508_193246-1536x2048.webp" class="service-thumb enlargeable" alt="Example event WiFi" loading="lazy" />
                  <img src="/img/20240508_193251-1536x2048.webp" class="service-thumb enlargeable" alt="Example guest network" loading="lazy" />
                  <img src="/img/20240508_194215-1536x1152.webp" class="service-thumb enlargeable" alt="Example access point" loading="lazy" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-2">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="services.card2.title">Productienetwerken</h5>
                <p class="text-muted" data-i18n="services.card2.body">Aparte VLANs voor leveranciers, ticketing, cashless, livestreams en pers.</p>
                <div class="service-thumbs mt-3" aria-label="Example photos">
                  <img src="/img/20240508_194215-1536x1152.webp" class="service-thumb enlargeable" alt="Example production network" loading="lazy" />
                  <img src="/img/20240508_204101-1536x2048.webp" class="service-thumb enlargeable" alt="Example network hardware" loading="lazy" />
                  <img src="/img/20240508_193246-1536x2048.webp" class="service-thumb enlargeable" alt="Example uplink" loading="lazy" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-3">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="services.card3.title">Snelle uitrol</h5>
                <p class="text-muted" data-i18n="services.card3.body">Modulaire kits met snel op te bouwen masten en redundante stroomvoorziening voor afgelegen locaties.</p>
                <div class="service-thumbs mt-3" aria-label="Example photos">
                  <img src="/img/20240508_204101-1536x2048.webp" class="service-thumb enlargeable" alt="Example rapid deployment" loading="lazy" />
                  <img src="/img/20240508_193251-1536x2048.webp" class="service-thumb enlargeable" alt="Example site build" loading="lazy" />
                  <img src="/img/20240508_194215-1536x1152.webp" class="service-thumb enlargeable" alt="Example outdoor setup" loading="lazy" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-4">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="services.card4.title">24/7 NOC</h5>
                <p class="text-muted" data-i18n="services.card4.body">Realtime telemetry, automatische failover en engineers on-call tijdens je event.</p>
                <div class="service-thumbs mt-3" aria-label="Example photos">
                  <img src="/img/20240508_194215-1536x1152.webp" class="service-thumb enlargeable" alt="Example monitoring" loading="lazy" />
                  <img src="/img/20240508_193246-1536x2048.webp" class="service-thumb enlargeable" alt="Example on-site ops" loading="lazy" />
                  <img src="/img/20240508_204101-1536x2048.webp" class="service-thumb enlargeable" alt="Example support" loading="lazy" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="reliability py-5" id="reliability">
      <div class="container py-4">
        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <p class="section-label" data-i18n="reliability.label">Betrouwbaarheid</p>
            <h2 class="fw-bold" data-i18n="reliability.title">Starlink + 5G-redundantie. Gegarandeerde uptime.</h2>
            <p class="text-white-50" data-i18n="reliability.lead">
              Twee Starlink-schotels met bonded routing leveren de primaire bandbreedte. Een 5G-verbinding staat
              klaar voor automatische failover, zodat kritieke diensten live blijven met een 99,98%-SLA.
            </p>
            <ul class="list-unstyled text-white-50">
              <li class="mb-2" data-i18n="reliability.item1">• Layer-3 bonding over meerdere uplinks</li>
              <li class="mb-2" data-i18n="reliability.item2">• Realtime QoS voor POS, staff en productie</li>
              <li class="mb-2" data-i18n="reliability.item3">• Live health-dashboard en proactieve alerts</li>
              <li class="mb-2" data-i18n="reliability.item4">• Kabel of glasvezel op locatie als primair; Starlink + 5G als back-up — ideaal voor kassa's</li>
            </ul>
          </div>
          <div class="col-lg-6">
            <div class="diagram fade-up">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="badge text-bg-light" data-i18n="reliability.diagram.primaryLabel">Primair</span>
                <span class="fw-semibold" data-i18n="reliability.diagram.primaryValue">Twee Starlink-schotels</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="badge text-bg-warning" data-i18n="reliability.diagram.backupLabel">Back-up</span>
                <span class="fw-semibold" data-i18n="reliability.diagram.backupValue">5G + LTE-router</span>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <span class="badge text-bg-info" data-i18n="reliability.diagram.outputLabel">Output</span>
                <span class="fw-semibold" data-i18n="reliability.diagram.outputValue">Beheerde WiFi-mesh</span>
              </div>
              <div class="mt-4 small text-white-50" data-i18n="reliability.diagram.note">Automatische omschakeling in minder dan 2 seconden.</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" id="use-cases">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="useCases.label">Toepassingen</p>
            <h2 class="fw-bold" data-i18n="useCases.title">Ontworpen voor landelijke locaties en events met hoge dichtheid.</h2>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-4">
            <div class="card use-case-card h-100 fade-up delay-1">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="useCases.card1.title">Kerst- & Paasmarkten</h5>
                <p class="text-muted" data-i18n="useCases.card1.body">Betrouwbare pinbetalingen en gast-wifi voor seizoensmarkten, cruciaal voor omzet.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card use-case-card h-100 fade-up delay-2">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="useCases.card2.title">Zomerkampen</h5>
                <p class="text-muted" data-i18n="useCases.card2.body">Internet voor kampleiding, veiligheid en logistiek op de meest afgelegen terreinen.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card use-case-card h-100 fade-up delay-3">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="useCases.card3.title">Sport- en buitenevenementen</h5>
                <p class="text-muted" data-i18n="useCases.card3.body">Live scoring, media-uplink en broadcast-klare connectiviteit onderweg.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card use-case-card h-100 fade-up delay-4">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="useCases.card4.title">Festivals & Evenementen</h5>
                <p class="text-muted" data-i18n="useCases.card4.body">Schaalbare wifi voor productie, artiesten en duizenden bezoekers.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card use-case-card h-100 fade-up delay-5">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="useCases.card5.title">Concerten en muziekfestivals</h5>
                <p class="text-muted" data-i18n="useCases.card5.body">Wifi voor grote concerten met hoge bezoekersaantallen en media-streaming.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card use-case-card h-100 fade-up delay-6">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="useCases.card6.title">Beurzen en tentoonstellingen</h5>
                <p class="text-muted" data-i18n="useCases.card6.body">Snelle connectiviteit voor exposanten, bezoekers en digitale interacties.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card use-case-card h-100 fade-up delay-7">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="useCases.card7.title">Bruiloften en ceremonies</h5>
                <p class="text-muted" data-i18n="useCases.card7.body">Betrouwbare wifi voor foto-uploads, livestreams en gastenconnectiviteit.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5 pattern-bg" id="pos-markets">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="pos.label">PoS WiFi</p>
            <h2 class="fw-bold" data-i18n="pos.title">Betrouwbare betalingen op markten.</h2>
            <p class="text-muted" data-i18n="pos.lead">
              Speciaal afgestemd op kassasystemen en transacties onder piekdrukte.
            </p>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-1">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="pos.card1.title">Dedicated PoS-SSID</h5>
                <p class="text-muted" data-i18n="pos.card1.body">Afgeschermde kassa-SSID met QoS en prioriteit voor pintransacties.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-2">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="pos.card2.title">Altijd online</h5>
                <p class="text-muted" data-i18n="pos.card2.body">Automatische failover via 5G en Starlink voor continue betalingen.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-3">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="pos.card3.title">Lage latency</h5>
                <p class="text-muted" data-i18n="pos.card3.body">Gestabiliseerde uplinks voor snelle autorisaties tijdens drukte.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-4">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="pos.card4.title">Live monitoring</h5>
                <p class="text-muted" data-i18n="pos.card4.body">Realtime toezicht en alerts op PoS-verbindingen tijdens de markt.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" id="video-surveillance">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="video.label">Video</p>
            <h2 class="fw-bold" data-i18n="video.title">Video- en camerabewaking op je event.</h2>
            <p class="text-muted" data-i18n="video.lead">
              IP-camera's over een apart VLAN, met veilige remote toegang en opslagopties.
            </p>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-1">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="video.card1.title">Complete infrastructuur</h5>
                <p class="text-muted" data-i18n="video.card1.body">Wij leveren de volledige netwerk- en stroominfrastructuur voor camera's, NVR's en kijkposten.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-2">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="video.card2.title">Live meekijken</h5>
                <p class="text-muted" data-i18n="video.card2.body">Beveiligde streams voor security, productie of organisatie.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-3">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="video.card3.title">Opname & opslag</h5>
                <p class="text-muted" data-i18n="video.card3.body">Lokale recorder (NVR) of upload naar jouw omgeving; retentie volgens afspraak.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card service-card h-100 fade-up delay-4">
              <div class="card-body">
                <h5 class="fw-semibold" data-i18n="video.card4.title">Integratie op locatie</h5>
                <p class="text-muted" data-i18n="video.card4.body">Bekabeld waar mogelijk, draadloos waar nodig — inclusief PoE en monitoring.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" id="gallery">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="gallery.label">Galerij</p>
            <h2 class="fw-bold" data-i18n="gallery.title">In actie bij events.</h2>
            <p class="text-muted" data-i18n="gallery.lead">Een greep uit recente deployments en live operations.</p>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-6 col-md-4 col-lg-3">
            <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
              <img
                src="/img/grootse-markt-2025/1748943099642.jpeg"
                class="w-100 h-100 gallery-img enlargeable"
                alt="Event WiFi deployment"
                data-i18n-alt="gallery.alt1"
                loading="lazy"
              />
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-3">
            <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
              <img
                src="/img/grootse-markt-2025/1748943179728.jpeg"
                class="w-100 h-100 gallery-img enlargeable"
                alt="Networking gear on-site"
                data-i18n-alt="gallery.alt2"
                loading="lazy"
              />
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-3">
            <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
              <img
                src="/img/grootse-markt-2025/1748943274377.jpeg"
                class="w-100 h-100 gallery-img enlargeable"
                alt="Event connectivity setup"
                data-i18n-alt="gallery.alt3"
                loading="lazy"
              />
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-3">
            <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
              <img
                src="/img/grootse-markt-2025/1748943404515.jpeg"
                class="w-100 h-100 gallery-img enlargeable"
                alt="Live event WiFi coverage"
                data-i18n-alt="gallery.alt4"
                loading="lazy"
              />
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-3">
            <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
              <img
                src="/img/20240508_193246-1536x2048.webp"
                class="w-100 h-100 gallery-img enlargeable"
                alt="Outdoor access points"
                data-i18n-alt="gallery.alt6"
                loading="lazy"
              />
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-3">
            <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
              <img
                src="/img/20240508_193251-1536x2048.webp"
                class="w-100 h-100 gallery-img enlargeable"
                alt="Antenna setup on site"
                data-i18n-alt="gallery.alt7"
                loading="lazy"
              />
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-3">
            <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
              <img
                src="/img/20240508_194215-1536x1152.webp"
                class="w-100 h-100 gallery-img enlargeable"
                alt="Network cabinet on site"
                data-i18n-alt="gallery.alt8"
                loading="lazy"
              />
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-3">
            <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
              <img
                src="/img/20240508_204101-1536x2048.webp"
                class="w-100 h-100 gallery-img enlargeable"
                alt="WiFi testing on site"
                data-i18n-alt="gallery.alt9"
                loading="lazy"
              />
            </div>
          </div>
          <div class="col-12 col-md-8 col-lg-6">
            <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm">
              <img
                src="/img/grootse-markt-2025/1748943441915.jpeg"
                class="w-100 h-100 gallery-img enlargeable"
                alt="Event operations team"
                data-i18n-alt="gallery.alt5"
                loading="lazy"
              />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" id="blog">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="blog.label">Blog</p>
            <h2 class="fw-bold" data-i18n="blog.title">Field notes and deployments.</h2>
            <p class="text-muted" data-i18n="blog.lead">
              Short updates and field notes from recent deployments.
            </p>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-12">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
              <h4 class="fw-semibold mb-0" data-i18n="blog.localTitle">Featured posts</h4>
              <a class="text-decoration-none" href="/blog" data-i18n="blog.allLink">All posts</a>
            </div>
            <div class="row g-4" id="blog-posts-local"></div>
            <p class="text-muted small mb-0 d-none" data-blog-local-status data-i18n="blog.empty">No posts yet.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" id="team">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="team.label">Team</p>
            <h2 class="fw-bold" data-i18n="team.title">People behind the network.</h2>
            <p class="text-muted" data-i18n="team.lead">Experienced operators focused on reliable event connectivity.</p>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-4">
            <div class="card service-card h-100">
              <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                  <img
                    src="/img/people/jarno.jpeg"
                    alt="Jarno Sulmann"
                    class="rounded-circle flex-shrink-0 enlargeable"
                    style="width: 80px; height: 80px; object-fit: cover; cursor: zoom-in"
                    loading="lazy"
                    decoding="async"
                  />
                  <div>
                    <h5 class="fw-semibold mb-1">Jarno Sulmann</h5>
                    <p class="text-muted mb-0" data-i18n="team.role1">Operations &amp; hardware on-site and in the field.</p>
                    <a class="small text-muted text-decoration-none" href="mailto:jarno@jarnowifi.net">jarno@jarnowifi.net</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card service-card h-100">
              <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                  <img
                    src="/img/people/joshua.jpeg"
                    alt="Joshua Treudler"
                    class="rounded-circle flex-shrink-0 enlargeable"
                    style="width: 80px; height: 80px; object-fit: cover; cursor: zoom-in"
                    loading="lazy"
                    decoding="async"
                  />
                  <div>
                    <h5 class="fw-semibold mb-1">Joshua Treudler</h5>
                    <p class="text-muted mb-0" data-i18n="team.role2">Operations and on-site operations.</p>
                    <a class="small text-muted text-decoration-none" href="mailto:joshua@jarnowifi.net">joshua@jarnowifi.net</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card service-card h-100">
              <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                  <div
                    class="rounded-circle flex-shrink-0 bg-light d-flex align-items-center justify-content-center"
                    style="width: 80px; height: 80px"
                    aria-hidden="true"
                  >
                    <span class="fw-bold">?</span>
                  </div>
                  <div>
                    <h5 class="fw-semibold mb-1" data-i18n="team.card3.name">You?</h5>
                    <p class="text-muted mb-1" data-i18n="team.role3">Freelance field engineers / installers for events.</p>
                    <p class="text-muted mb-0" data-i18n="team.role4">Head of Sales</p>
                    <a class="small text-muted text-decoration-none" href="/jobs" data-i18n="team.card3.cta">See jobs</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5 pattern-bg" id="pricing">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="pricing.label">Pakketten</p>
            <h2 class="fw-bold" data-i18n="pricing.title">Transparante pakketten die meeschalen.</h2>
            <p class="text-muted" data-i18n="pricing.lead">Elke deployment bevat monitoring, redundantie en ondersteuning op locatie.</p>
            <div class="mb-2">
              <span class="discount-pill" data-i18n="pricing.discount">€ 100 korting per pakket</span>
            </div>
            <p class="text-muted small mb-1" data-i18n="pricing.note">Prijzen per dag. Op- en afbouw en voorrijkosten worden apart berekend.</p>
            <p class="text-muted small mb-0" data-i18n="pricing.capacityNote">Gastcapaciteit hangt af van de uplink: Starlink tot 500 Mbps, glasvezel meerdere Gbps.</p>
          </div>
        </div>
        <div class="row g-4 align-items-stretch">
          <div class="col-lg-4">
            <div class="plan-card h-100 p-4">
              <h5 class="fw-semibold" data-i18n="pricing.card1.title">Trailblazer</h5>
              <p class="text-muted small" data-i18n="pricing.card1.subtitle">Tot 50 gasten gegarandeerd (meer mogelijk)</p>
              <h3 class="fw-bold" data-i18n="pricing.card1.price">Vanaf € 150 / dag</h3>
              <div class="mb-4">
                <span class="discount-pill" data-i18n="pricing.card1.discount">€ 100 korting</span>
              </div>
              <div class="text-muted">
                <div class="plan-item" data-i18n="pricing.card1.item1">Enkele Starlink + 5G-back-up</div>
                <div class="plan-item" data-i18n="pricing.card1.item2">6 access points</div>
                <div class="plan-item" data-i18n="pricing.card1.item3">Monitoring op afstand</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="plan-card featured h-100 p-4">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <h5 class="fw-semibold mb-0" data-i18n="pricing.card2.title">Summit</h5>
                <span class="badge text-bg-warning" data-i18n="pricing.card2.badge">Meest geboekt</span>
              </div>
              <p class="text-muted small" data-i18n="pricing.card2.subtitle">Tot 150 gasten gegarandeerd (meer mogelijk)</p>
              <h3 class="fw-bold" data-i18n="pricing.card2.price">Vanaf € 350 / dag</h3>
              <div class="mb-4">
                <span class="discount-pill" data-i18n="pricing.card2.discount">€ 100 korting</span>
              </div>
              <div class="text-muted">
                <div class="plan-item" data-i18n="pricing.card2.item1">Twee Starlink + bonded 5G</div>
                <div class="plan-item" data-i18n="pricing.card2.item2">12 access points</div>
                <div class="plan-item" data-i18n="pricing.card2.item3">Engineer op locatie</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="plan-card h-100 p-4">
              <h5 class="fw-semibold" data-i18n="pricing.card3.title">Frontier</h5>
              <p class="text-muted small" data-i18n="pricing.card3.subtitle">Tot 250 gasten gegarandeerd (meer mogelijk)</p>
              <h3 class="fw-bold" data-i18n="pricing.card3.price">Vanaf € 550 / dag</h3>
              <div class="mb-4">
                <span class="discount-pill" data-i18n="pricing.card3.discount">€ 100 korting</span>
              </div>
              <div class="text-muted">
                <div class="plan-item" data-i18n="pricing.card3.item1">Multi-site mesh + redundantie</div>
                <div class="plan-item" data-i18n="pricing.card3.item2">Dedicated NOC-kanaal</div>
                <div class="plan-item" data-i18n="pricing.card3.item3">SLA-uitbreidingen</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" id="long-term-offers">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-7">
            <p class="section-label" data-i18n="longterm.label">Langetermijn</p>
            <h2 class="fw-bold" data-i18n="longterm.title">Langetermijn aanbiedingen.</h2>
            <p class="text-muted" data-i18n="longterm.lead">Voor vaste locaties en terugkerende events.</p>
            <p class="text-muted small mb-2" data-i18n="longterm.billing">Per maand, jaarlijks gefactureerd.</p>
            <p class="text-muted small mb-0" data-i18n="longterm.fiberNote">We gebruiken glasvezel of kabel indien beschikbaar.</p>
          </div>
        </div>
        <div class="row g-4 align-items-stretch">
          <div class="col-md-6">
            <div class="plan-card h-100 p-4">
              <h5 class="fw-semibold" data-i18n="longterm.card1.title">3 APs + Starlink + 5G</h5>
              <h3 class="fw-bold" data-i18n="longterm.card1.price">€ 349 / maand</h3>
              <p class="text-muted mb-3" data-i18n="longterm.card1.capacity">Tot 100 clients</p>
              <div class="text-muted mb-0">
                <div class="plan-item" data-i18n="longterm.card1.item1">3 access points inbegrepen</div>
                <div class="plan-item" data-i18n="longterm.card1.item2">Starlink primair + 5G-back-up</div>
                <div class="plan-item" data-i18n="longterm.card1.item3">Ideaal voor kleinere locaties</div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="plan-card h-100 p-4">
              <h5 class="fw-semibold" data-i18n="longterm.card2.title">10 APs</h5>
              <h3 class="fw-bold" data-i18n="longterm.card2.price">€ 649 / maand</h3>
              <p class="text-muted mb-3" data-i18n="longterm.card2.capacity">Voor grotere locaties en teams</p>
              <div class="text-muted mb-0">
                <div class="plan-item" data-i18n="longterm.card2.item1">10 access points inbegrepen</div>
                <div class="plan-item" data-i18n="longterm.card2.item2">Schaalbaar voor grotere locaties</div>
                <div class="plan-item" data-i18n="longterm.card2.item3">Uplink via glasvezel/kabel indien beschikbaar</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" id="faq">
      <div class="container py-4">
        <div class="row mb-4">
          <div class="col-lg-6">
            <p class="section-label" data-i18n="faq.label">FAQ</p>
            <h2 class="fw-bold" data-i18n="faq.title">Vragen, beantwoord.</h2>
          </div>
        </div>
        <div class="accordion" id="faqAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne" data-i18n="faq.q1">
                Hoe snel kunnen jullie op locatie uitrollen?
              </button>
            </h2>
            <div id="faqOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
              <div class="accordion-body" data-i18n="faq.a1">
                De meeste events zijn binnen 6-12 uur live, afhankelijk van terrein en toegang. We kunnen hardware
                vooraf klaarzetten voor activaties op dezelfde dag.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo" data-i18n="faq.q2">
                Wat dekt de 99,98% SLA?
              </button>
            </h2>
            <div id="faqTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body" data-i18n="faq.a2">
                Deze dekt de uptime van de managed WiFi-dienst met redundante uplinks en gemonitorde routing.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThree" data-i18n="faq.q3">
                Kunnen jullie gast- en stafnetwerken scheiden?
              </button>
            </h2>
            <div id="faqThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body" data-i18n="faq.a3">
                Ja. We configureren aparte SSID's en VLANs met QoS-prioriteit voor POS, staff en media.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqFour" data-i18n="faq.q4">
                Kunnen jullie een captive portal / branded loginpagina leveren?
              </button>
            </h2>
            <div id="faqFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body" data-i18n="faq.a4">
                Ja. We leveren een captive portal met jouw logo en voorwaarden, met optionele limieten per gebruiker (tijd/bandbreedte).
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqFive" data-i18n="faq.q5">
                Wat als er geen vaste internetlijn is op locatie?
              </button>
            </h2>
            <div id="faqFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body" data-i18n="faq.a5">
                Dan leveren we Starlink als primaire uplink met 5G-back-up. Als glasvezel/kabel beschikbaar is, gebruiken we die primair en Starlink/5G als redundantie.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqSix" data-i18n="faq.q6">
                Hoe bepalen jullie capaciteit en aantal access points?
              </button>
            </h2>
            <div id="faqSix" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body" data-i18n="faq.a6">
                Op basis van bezoekersaantallen, het type gebruik (POS/ticketing/media), terrein en uplink. We ontwerpen vooraf en monitoren live om bij te sturen.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqSeven" data-i18n="faq.q7">
                Hoe zit het met privacy en logging?
              </button>
            </h2>
            <div id="faqSeven" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body" data-i18n="faq.a7">
                We loggen alleen wat nodig is voor beheer en troubleshooting. Bewaartermijnen en eventuele eisen stemmen we per event af.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" id="contact">
      <div class="container py-4">
        <div class="cta-band mb-5">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <h2 class="fw-bold" data-i18n="contact.cta.title">Klaar om je volgende event te verbinden?</h2>
              <p class="mb-0" data-i18n="contact.cta.lead">Deel je datum en locatie — we leveren binnen 24 uur een deploymentplan.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
              <a class="btn btn-dark btn-lg" href="mailto:hello@jarnowifi.net">hello@jarnowifi.net</a>
            </div>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-lg-5">
            <h3 class="fw-semibold" data-i18n="contact.info.title">Offerte aanvragen</h3>
            <p class="text-muted" data-i18n="contact.info.lead">Vertel ons over je locatie en we sturen een plan op maat terug.</p>
            <div class="d-grid gap-3">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold" data-i18n="contact.info.phoneLabel">Sales/Vertrieb</span>
                <a href="tel:+4969175549160" data-i18n="contact.info.phoneValue">+49 69 1755 491 160</a>
              </div>
              <div class="d-flex justify-content-between">
                <span class="fw-semibold" data-i18n="contact.info.responseLabel">Reactietijd</span>
                <span data-i18n="contact.info.responseValue">binnen 24 uur</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="fw-semibold" data-i18n="contact.info.coverageLabel">Servicegebied</span>
                <span data-i18n="contact.info.coverageValue">Benelux + Duitsland</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="fw-semibold" data-i18n="contact.info.supportLabel">Support</span>
                <span data-i18n="contact.info.supportValue">Op locatie + remote NOC</span>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <form class="row g-3" action="contact.php" method="post" accept-charset="UTF-8" data-contact-form>
              <input type="hidden" name="lang" value="" data-lang-field />
              <div class="col-md-6">
                <label class="form-label" data-i18n="contact.form.nameLabel">Volledige naam</label>
                <input type="text" class="form-control" name="full_name" placeholder="Alex Morgan" data-i18n-placeholder="contact.form.namePlaceholder" />
              </div>
              <div class="col-md-6">
                <label class="form-label" data-i18n="contact.form.emailLabel">E-mailadres</label>
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  placeholder="naam@bedrijf.nl"
                  data-i18n-placeholder="contact.form.emailPlaceholder"
                  required
                />
              </div>
              <div class="col-12">
                <label class="form-label" data-i18n="contact.form.notesLabel">Opmerkingen</label>
                <textarea class="form-control" name="notes" rows="4" placeholder="Stroomvoorziening, indeling, speciale wensen" data-i18n-placeholder="contact.form.notesPlaceholder" required></textarea>
              </div>
              <div class="col-12 d-none">
                <label class="form-label" for="website-field">Website</label>
                <input type="text" class="form-control" id="website-field" name="website" autocomplete="off" />
              </div>
              <div class="col-12">
                <div class="alert d-none mb-0" role="status" aria-live="polite" data-contact-status></div>
              </div>
              <div class="col-12">
                <button class="btn btn-lg cta-primary w-100" type="submit" data-i18n="contact.form.submit">Verstuur aanvraag</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <?php include 'partials/footer.php'; ?>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script type="module">
      import { i18n } from '/js/i18n.js';
      import { loadBlogPosts, setupImageEnlargement } from '/js/blog-helpers.js';
      
      document.addEventListener('DOMContentLoaded', async () => {
        // Load menu module
        await import('/menu.js');
        
        await i18n.init();
        await window.loadHeader({ active: 'home' });
        await window.loadFooter();
        
        // Load blog posts
        const blogContainer = document.getElementById('blog-posts-local');
        if (blogContainer) {
          await loadBlogPosts(blogContainer.id, '/data/blog-posts.json', { limit: 3 });
        }
        
        setupImageEnlargement();

        // Contact form handling
        const contactForm = document.querySelector('[data-contact-form]');
        const contactStatus = document.querySelector('[data-contact-status]');
        const langField = document.querySelector('[data-lang-field]');

        function setContactStatus(message, style) {
          if (!contactStatus) return;
          contactStatus.textContent = message;
          contactStatus.classList.remove("d-none", "alert-success", "alert-danger", "alert-info");
          if (style === "success") {
            contactStatus.classList.add("alert", "alert-success");
          } else if (style === "error") {
            contactStatus.classList.add("alert", "alert-danger");
          } else {
            contactStatus.classList.add("alert", "alert-info");
          }
        }

        if (contactForm) {
          contactForm.addEventListener("submit", async (event) => {
            event.preventDefault();
            setContactStatus(i18n.t("contact.form.sending", "Sending..."), "info");

            try {
              const response = await fetch(contactForm.action, {
                method: "POST",
                headers: {
                  "Accept": "application/json",
                  "X-Requested-With": "fetch"
                },
                body: new FormData(contactForm)
              });

              let data = null;
              try {
                data = await response.json();
              } catch (error) {
                data = null;
              }

              if (!response.ok || !data || !data.ok) {
                if (data && data.error) {
                  console.error("Contact form error:", data.error);
                }
                setContactStatus(i18n.t("contact.form.error", "Sending failed."), "error");
                return;
              }

              setContactStatus(i18n.t("contact.form.success", "Message sent."), "success");
              contactForm.reset();
              if (langField) {
                langField.value = i18n.getCurrentLanguage();
              }
            } catch (error) {
              console.error("Contact form error:", error);
              setContactStatus(i18n.t("contact.form.error", "Sending failed."), "error");
            }
          });
        }
      });
    </script>

    <?php include 'partials/modal.php'; ?>
  </body>
</html>
