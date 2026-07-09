<section id="hizmetler" class="container section-padding">
        <div class="text-center mb-5">
            <h2 class="section-title">
                <span data-bind="services.section_title">{{ data_get($settings, 'services.section_title', 'Neden Bizimle Çalışmalısınız?') }}</span>
            </h2>
            <p class="text-muted max-w-2xl mx-auto">
                <span data-bind="services.section_subtitle">{{ data_get($settings, 'services.section_subtitle', 'Sizler için en yüksek standartlarda kurumsal çözümler üretiyoruz.') }}</span>
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="kurumsal-kart h-100">
                    <div class="kart-ikon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h5 class="fw-bold mb-3">
                        <span data-bind="services.item_1_title">{{ data_get($settings, 'services.item_1_title', 'Yüksek Güvenlik') }}</span>
                    </h5>
                    <p class="text-muted small m-0">
                        <span data-bind="services.item_1_desc">{{ data_get($settings, 'services.item_1_desc', 'Verileriniz ve tüm dijital süreçleriniz uçtan uca modern güvenlik duvarları ile korunur.') }}</span>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kurumsal-kart h-100">
                    <div class="kart-ikon">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h5 class="fw-bold mb-3">
                        <span data-bind="services.item_2_title">{{ data_get($settings, 'services.item_2_title', 'Tam Performans') }}</span>
                    </h5>
                    <p class="text-muted small m-0">
                        <span data-bind="services.item_2_desc">{{ data_get($settings, 'services.item_2_desc', 'Gecikme olmadan, her talebe anında yanıt veren ultra hızlı entegrasyon çözümleri.') }}</span>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kurumsal-kart h-100">
                    <div class="kart-ikon">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h5 class="fw-bold mb-3">
                        <span data-bind="services.item_3_title">{{ data_get($settings, 'services.item_3_title', '7/24 Destek') }}</span>
                    </h5>
                    <p class="text-muted small m-0">
                        <span data-bind="services.item_3_desc">{{ data_get($settings, 'services.item_3_desc', 'İhtiyaç duyduğunuz her an uzman kadromuzla yanınızda yer alarak operasyonlarınızı destekliyoruz.') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
