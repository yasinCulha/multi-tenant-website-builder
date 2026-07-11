<section id="ana-sayfa" class="cb-hero">
    <div class="cb-container cb-hero__grid">
        <div class="cb-hero__content">
            <span class="cb-eyebrow">{{ data_get($settings ?? [], 'hero.badge_text', 'Kurumsal Cozumler') }}</span>
            <h1>{{ data_get($settings ?? [], 'hero.title', 'Isinizi Dijital Dunyada Guvenle Buyutun') }}</h1>
            <p>{{ data_get($settings ?? [], 'hero.description', 'Markaniz icin hizli, guvenilir ve olceklenebilir dijital deneyimler tasarliyoruz.') }}</p>
            <div class="cb-hero__actions">
                <a class="cb-button" href="{{ data_get($settings ?? [], 'navbar.cta_button_url', '#iletisim') }}">{{ data_get($settings ?? [], 'hero.button_primary_text', 'Teklif Al') }}</a>
                <a class="cb-button cb-button--ghost" href="#hakkimizda">{{ data_get($settings ?? [], 'hero.button_secondary_text', 'Daha Fazla Bilgi') }}</a>
            </div>
        </div>
        <div class="cb-hero__panel" aria-label="Kurumsal performans ozeti">
            <span>{{ data_get($settings ?? [], 'about.stat_1_value', '100+') }}</span>
            <strong>{{ data_get($settings ?? [], 'about.stat_1_label', 'Tamamlanan Proje') }}</strong>
            <p>{{ data_get($settings ?? [], 'general.company_name', $company->name ?? 'Firma') }} ekipleri icin sade, guvenli ve modern cozumler.</p>
        </div>
    </div>
</section>
