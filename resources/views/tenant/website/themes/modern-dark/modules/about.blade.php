<section id="hakkimizda" class="md-about">
    <div class="md-container md-about__grid">
        <div>
            <span class="md-eyebrow">About</span>
            <h2>{{ data_get($settings ?? [], 'about.section_title', 'Teknolojiyle guclenen yaratıcı ekip') }}</h2>
            <p>{{ data_get($settings ?? [], 'about.description', 'Fikirleri hizli prototiplere, prototipleri guvenilir dijital urunlere donusturuyoruz.') }}</p>
        </div>
        <div class="md-about__stats">
            <div><strong>{{ data_get($settings ?? [], 'about.stat_1_value', '100+') }}</strong><span>{{ data_get($settings ?? [], 'about.stat_1_label', 'Proje') }}</span></div>
            <div><strong>{{ data_get($settings ?? [], 'about.stat_2_value', '50+') }}</strong><span>{{ data_get($settings ?? [], 'about.stat_2_label', 'Musteri') }}</span></div>
            <div><strong>{{ data_get($settings ?? [], 'about.stat_3_value', '24/7') }}</strong><span>{{ data_get($settings ?? [], 'about.stat_3_label', 'Destek') }}</span></div>
        </div>
    </div>
</section>
