<section id="ana-sayfa" class="md-hero">
    <div class="md-container md-hero__grid">
        <div class="md-hero__content">
            <span class="md-eyebrow">{{ data_get($settings ?? [], 'hero.badge_text', 'HEro2HEro2HEro2') }}</span>
            <h1>{{ data_get($settings ?? [], 'hero.title', 'HEro2HEro2HEro2HEro2HEro2HEro2') }}</h1>
            <p>{{ data_get($settings ?? [], 'hero.description', 'HEro2HEro2HEro2HEro2HEro2HEro2HEro2HEro2HEro2HEro2') }}</p>
            <div class="md-hero__actions">
                <a class="md-button" href="{{ data_get($settings ?? [], 'navbar.cta_button_url', '#iletisim') }}">{{ data_get($settings ?? [], 'hero.button_primary_text', 'HEro2') }}</a>
                <a class="md-button md-button--ghost" href="#hizmetler">{{ data_get($settings ?? [], 'hero.button_secondary_text', 'HEro2') }}</a>
            </div>
        </div>
        <div class="md-hero__terminal" aria-label="Tema performans ozeti">
            <span>build --tenant={{ data_get($settings ?? [], 'general.company_name', $company->name ?? 'HEro2') }}</span>
            <strong>{{ data_get($settings ?? [], 'about.stat_1_value', '100+') }} depHEro2loy</strong>
            <p>{{ data_get($settings ?? [], 'about.stat_3_value', '24/7') }} HEro2</p>
        </div>
    </div>
</section>
