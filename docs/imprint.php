<!doctype html>
<html lang="de">
  <head>
    <?php
      $metaTitle = 'Impressum — JarnoWiFi';
      $metaDescription = 'Rechtliche Angaben und Kontaktinformationen zu JarnoWiFi.';
      $metaImage = '/img/people/jarno.jpeg';
    ?>
    <?php include 'partials/meta-common.php'; ?>
    <title>Impressum — JarnoWiFi</title>
  </head>
  <body>
    <div data-include="header" data-active="imprint"></div>

    <main class="page-shell">
      <section class="mb-5">
        <div class="container">
          <div class="hero-video">
            <div class="hero-video__overlay"></div>
            <div class="container hero-video__content">
              <div class="row justify-content-center mx-0">
                <div class="col-lg-8">
                  <p class="section-label mb-2" data-i18n="impressum.label">Impressum</p>
                  <h1 class="fw-bold mb-3" data-i18n="impressum.title"><span class="text-gradient">Impressum</span></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card info-card p-4 mb-4">
              <h5 class="fw-semibold" data-i18n="impressum.provider.title">Anbieter</h5>
              <div class="text-muted">
                <div data-i18n="impressum.provider.value">Jarno Sulmann trading as JarnoWiFi</div>
                <div class="mt-3 fw-semibold" data-i18n="impressum.represented.title">Vertretungsberechtigte Person</div>
                <div data-i18n="impressum.represented.value">Jarno Sulmann, Joshua Treudler</div>
                <div class="mt-3" data-i18n="impressum.address.title">Adresse</div>
                <div data-i18n="impressum.address.line1">Penningkruid 71</div>
                <div data-i18n="impressum.address.line2">7765 BS Weiteveen</div>
                <div data-i18n="impressum.address.line3">Niederlande</div>
              </div>
            </div>

            <div class="card info-card p-4 mb-4">
              <h5 class="fw-semibold" data-i18n="impressum.contact.title">Kontakt</h5>
              <div class="text-muted">
                <div>
                  <span class="fw-semibold" data-i18n="impressum.contact.emailLabel">E-Mail</span>:
                  <span data-i18n="impressum.contact.emailValue">contact@jarnowifi.net</span>
                </div>
                <div>
                  <span class="fw-semibold" data-i18n="impressum.contact.nocLabel">NOC</span>:
                  <span data-i18n="impressum.contact.nocValue">noc@jarnowifi.net</span>
                </div>
                <div>
                  <span class="fw-semibold" data-i18n="impressum.contact.salesLabel">Vertrieb</span>:
                  <a href="tel:+4969175549160" data-i18n="impressum.contact.salesValue">+49 69 1755 491 160</a>
                </div>
                <div>
                  <span class="fw-semibold" data-i18n="impressum.contact.incidentsLabel">Störungen</span>:
                  <a href="tel:+4969175549160" data-i18n="impressum.contact.incidentsValue">+49 69 1755 491 161</a>
                </div>
                <div>
                  <span class="fw-semibold" data-i18n="impressum.contact.webLabel">Website</span>:
                  <span data-i18n="impressum.contact.webValue">jarnowifi.net</span>
                </div>
              </div>
            </div>

            <div class="card info-card p-4 mb-4">
              <h5 class="fw-semibold" data-i18n="impressum.register.title">Registereintrag</h5>
              <p class="text-muted mb-0" data-i18n="impressum.register.value">Nicht im Handelsregister eingetragen.</p>
            </div>

            <div class="card info-card p-4 mb-4">
              <h5 class="fw-semibold" data-i18n="impressum.vat.title">BTW</h5>
              <p class="text-muted mb-0" data-i18n="impressum.vat.value">KOR (kleineondernemersregeling), geen btw vermeld.</p>
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
        await window.loadHeader({ active: 'imprint' });
        await window.loadFooter();
      });
    </script>
  </body>
</html>
