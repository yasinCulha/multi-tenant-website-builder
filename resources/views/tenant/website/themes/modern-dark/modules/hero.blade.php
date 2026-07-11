<section id="ana-sayfa" class="md-hero">
    <div class="md-container md-hero__grid">
        <div class="md-hero__content">
            <span class="md-eyebrow">{{ data_get($settings ?? [], 'hero.badge_text', 'Digital Studio') }}</span>
            <h1>{{ data_get($settings ?? [], 'hero.title', 'Modern, hizli ve etkileyici web deneyimleri') }}</h1>
            <p>{{ data_get($settings ?? [], 'hero.description', 'Markanizi karanlik, guclu ve teknoloji odakli bir sahneyle one cikariyoruz.') }}</p>
            <div class="md-hero__actions">
                <a class="md-button" href="{{ data_get($settings ?? [], 'navbar.cta_button_url', '#iletisim') }}">{{ data_get($settings ?? [], 'hero.button_primary_text', 'Baslayalim') }}</a>
                <a class="md-button md-button--ghost" href="#hizmetler">{{ data_get($settings ?? [], 'hero.button_secondary_text', 'Isleri Gor') }}</a>
            </div>
        </div>
        <div class="md-hero__terminal" aria-label="Tema performans ozeti">
            <span>build --tenant={{ data_get($settings ?? [], 'general.company_name', $company->name ?? 'firma') }}</span>
            <strong>{{ data_get($settings ?? [], 'about.stat_1_value', '100+') }} deploy</strong>
            <p>{{ data_get($settings ?? [], 'about.stat_3_value', '24/7') }} uptime mindset</p>
        </div>
    </div>
</section>
