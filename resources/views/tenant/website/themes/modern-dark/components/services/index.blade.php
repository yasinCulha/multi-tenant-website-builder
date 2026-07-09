 <section id="hizmetler" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-white">
                    <span data-bind="services.section_title">
                        {{ data_get($settings, 'services.section_title', 'Neler Yapıyoruz?') }}
                    </span>
                </h2>
                <p class="text-gray">
                    <span data-bind="services.section_subtitle">
                        {{ data_get($settings, 'services.section_subtitle', 'İhtiyaçlarınıza özel uçtan uca modern yazılım çözümleri') }}
                    </span>
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="hizmet-karti h-100">
                        <div class="hizmet-ikonu"><i class="fa-solid fa-code"></i></div>
                            <h5 class="text-white fw-bold mb-3">
                                <span data-bind="services.item_1_title">
                                    {{ data_get($settings, 'services.item_1_title', 'Özel Web Yazılımları') }}
                                </span>
                            </h5>
                        <p class="small text-secondary m-0">
                            <span data-bind="services.item_1_desc">
                                {{ data_get($settings, 'services.item_1_desc', 'Yüksek performanslı, SEO uyumlu ve her ekrana tam oturan modern web uygulamaları geliştiriyoruz.') }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hizmet-karti h-100">
                        <div class="hizmet-ikonu"><i class="fa-solid fa-brain"></i></div>
                        <h5 class="text-white fw-bold mb-3">
                            <span data-bind="services.item_2_title">
                                {{ data_get($settings, 'services.item_2_title', 'Yapay Zeka & Veri') }}
                            </span>
                        </h5>
                        <p class="small text-secondary m-0" >
                            <span data-bind="services.item_2_desc">
                                {{ data_get($settings, 'services.item_2_desc', 'Verilerinizi anlamlı raporlara dönüştürüyor, iş süreçlerinizi otomatize edecek AI modelleri kuruyoruz.') }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hizmet-karti h-100">
                        <div class="hizmet-ikonu"><i class="fa-solid fa-shield-halved"></i></div>
                        <h5 class="text-white fw-bold mb-3" >
                            <span data-bind="services.item_3_title">
                                {{ data_get($settings, 'services.item_3_title', 'Siber Güvenlik') }}
                            </span>
                        </h5>
                        <p class="small text-secondary m-0">
                            <span data-bind="services.item_3_desc">
                                {{ data_get($settings, 'services.item_3_desc', 'Sistemlerinizin güvenliğini en üst seviyede tutmak için sızma testleri ve veri güvenliği optimizasyonları yapıyoruz.') }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>