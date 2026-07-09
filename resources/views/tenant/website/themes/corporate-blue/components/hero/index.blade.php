<header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="hero-badge">
                        <i class="fa-solid fa-sparkles me-1"></i>
                        <span data-bind="hero.badge_text">{{ data_get($settings, 'hero.badge_text', 'Kurumsal Çözümler') }}</span>
                    </span>
                    <h1 class="hero-title" id="heroTitlePreview"  data-bind="hero.styles.title_color" data-bind-style="color"style="color:{{ data_get($settings,'hero.styles.title_color','#4169E1') }}">
                        <span data-bind="hero.title">{{ data_get($settings, 'hero.title', 'İşinizi Dijital Dünyada Güvenle Büyütün') }}</span>
                    </h1>
                    <p class="hero-desc" id="heroDescriptionPreview">
                        <span data-bind="hero.description">{{ data_get($settings, 'hero.description', 'Bu varsayılan açıklamadır.') }}</span>
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ data_get($settings, 'hero.button_primary_url', '#iletisim') }}" data-bind-href="hero.button_primary_url" class="btn btn-kurumsal text-decoration-none shadow-sm" id="heroButtonPreview">
                            <span data-bind="hero.button_primary_text">{{ data_get($settings, 'hero.button_primary_text', 'Hemen Başlayın') }}</span>
                        </a>
                        <a href="{{ data_get($settings, 'hero.button_secondary_url', '#hakkimizda') }}" data-bind-href="hero.button_secondary_url" class="btn btn-kurumsal-outline text-decoration-none" id="aboutButtonPreview">
                            <span data-bind="hero.button_secondary_text">{{ data_get($settings, 'hero.button_secondary_text', 'Bizi Tanıyın') }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-end">
                    <i class="fa-solid fa-chart-line" style="font-size: 280px; color: rgba(15, 82, 186, 0.05);"></i>
                </div>
            </div>
        </div>
    </header>