<section id="hizmetler" class="md-services">
    <div class="md-container">
        <div class="md-section-heading">
            <span class="md-eyebrow">Capabilities</span>
            <h2>{{ data_get($settings ?? [], 'services.section_title', 'Neden Bizimle Calismalisiniz?') }}</h2>
            <p>{{ data_get($settings ?? [], 'services.section_subtitle', 'Yuksek enerjili, olceklenebilir ve net dijital cozumler.') }}</p>
        </div>

        <div class="md-services__grid">
            <article class="md-glass-card">
                <span>01</span>
                <h3>{{ data_get($settings ?? [], 'services.item_1_title', 'Guvenli Mimari') }}</h3>
                <p>{{ data_get($settings ?? [], 'services.item_1_desc', 'Veri, performans ve deneyimi ayni mimaride toplariz.') }}</p>
            </article>
            <article class="md-glass-card">
                <span>02</span>
                <h3>{{ data_get($settings ?? [], 'services.item_2_title', 'Hizli Deneyim') }}</h3>
                <p>{{ data_get($settings ?? [], 'services.item_2_desc', 'Kullanici akislarini hizli, sade ve etkili hale getiririz.') }}</p>
            </article>
            <article class="md-glass-card">
                <span>03</span>
                <h3>{{ data_get($settings ?? [], 'services.item_3_title', 'Surekli Gelisim') }}</h3>
                <p>{{ data_get($settings ?? [], 'services.item_3_desc', 'Yayindan sonra da olculebilir iyilestirmelerle ilerleriz.') }}</p>
            </article>
        </div>
    </div>
</section>
