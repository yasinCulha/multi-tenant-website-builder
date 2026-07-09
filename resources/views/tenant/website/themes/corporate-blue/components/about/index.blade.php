<section id="hakkimizda" class="hakkimizda-section section-padding">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="section-title">
                        <span data-bind="about.section_title">{{ data_get($settings, 'about.section_title', 'Kurumsal Başarı Hikayemiz') }}</span>
                    </h2>
                    <p class="text-muted mt-3 mb-4">
                        <span data-bind="about.description">
                            {{ data_get($settings, 'about.description', $company->name . ' olarak kurulduğumuz günden bu yana müşterilerimizin dijital dönüşüm yolculuğunda yanlarında yer alıyoruz.') }}
                        </span>
                    </p>
                    <div class="row g-4 border-top pt-4">
                        <div class="col-6 col-sm-4">
                            <div class="istatistik-kutusu">
                                <div class="istatistik-sayi">
                                    <span data-bind="about.stat_1_value">{{ data_get($settings, 'about.stat_1_value', '500+') }}</span>
                                </div>
                                <div class="small text-muted fw-medium">
                                    <span data-bind="about.stat_1_label">{{ data_get($settings, 'about.stat_1_label', 'Mutlu Müşteri') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="istatistik-kutusu">
                                <div class="istatistik-sayi">
                                    <span data-bind="about.stat_2_value">{{ data_get($settings, 'about.stat_2_value', '12+') }}</span>
                                </div>
                                <div class="small text-muted fw-medium">
                                    <span data-bind="about.stat_2_label">{{ data_get($settings, 'about.stat_2_label', 'Yıllık Tecrübe') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="istatistik-kutusu">
                                <div class="istatistik-sayi">
                                    <span data-bind="about.stat_3_value">{{ data_get($settings, 'about.stat_3_value', '24/7') }}</span>
                                </div>
                                <div class="small text-muted fw-medium">
                                    <span data-bind="about.stat_3_label">{{ data_get($settings, 'about.stat_3_label', 'Aktif İzleme') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <i class="fa-solid fa-handshake" style="font-size: 240px; color: rgba(15, 82, 186, 0.05);"></i>
                </div>
            </div>
        </div>
    </section>
