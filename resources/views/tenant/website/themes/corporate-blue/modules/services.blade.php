<section id="hizmetler" class="cb-services">
    <div class="cb-container">
        <div class="cb-section-heading">
            <span class="cb-eyebrow">Hizmetler</span>
            <h2>{{ data_get($settings ?? [], 'services.section_title', 'Neden Bizimle Calismalisiniz?') }}</h2>
            <p>{{ data_get($settings ?? [], 'services.section_subtitle', 'Kurumsal ihtiyaclariniz icin yuksek standartlarda cozumler uretiyoruz.') }}</p>
        </div>

        <div class="cb-services__grid">
            <article class="cb-card">
                <span>01</span>
                <h3>{{ data_get($settings ?? [], 'services.item_1_title', 'Yuksek Guvenlik') }}</h3>
                <p>{{ data_get($settings ?? [], 'services.item_1_desc', 'Sistemlerinizi modern guvenlik yaklasimlariyla koruruz.') }}</p>
            </article>
            <article class="cb-card">
                <span>02</span>
                <h3>{{ data_get($settings ?? [], 'services.item_2_title', 'Tam Performans') }}</h3>
                <p>{{ data_get($settings ?? [], 'services.item_2_desc', 'Hizli, olceklenebilir ve stabil dijital altyapilar kurariz.') }}</p>
            </article>
            <article class="cb-card">
                <span>03</span>
                <h3>{{ data_get($settings ?? [], 'services.item_3_title', '7/24 Destek') }}</h3>
                <p>{{ data_get($settings ?? [], 'services.item_3_desc', 'Operasyonlariniz icin surekli destek ve danismanlik saglariz.') }}</p>
            </article>
        </div>
    </div>
</section>
