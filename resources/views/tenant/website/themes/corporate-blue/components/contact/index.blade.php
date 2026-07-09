<section id="iletisim" class="iletisim-section section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">
                    <span data-bind="contact.section_title">{{ data_get($settings, 'contact.section_title', 'Bizimle İletişime Geçin') }}</span>
                </h2>
                <p class="text-muted">
                    <span data-bind="contact.section_subtitle">{{ data_get($settings, 'contact.section_subtitle', 'Sorularınız veya iş birliği talepleriniz için formu doldurabilir veya doğrudan bize ulaşabilirsiniz.') }}</span>
                </p>
            </div>

            <div class="row g-5">
                <!-- İletişim Bilgileri (Sol Sütun) -->
                <div class="col-lg-5">
                    <div class="kurumsal-kart h-100">
                        <h4 class="fw-bold text-dark mb-4">
                            <span data-bind="contact.info_title">{{ data_get($settings, 'contact.info_title', 'İletişim Bilgileri') }}</span>
                        </h4>
                        
                        <div class="iletisim-bilgi-satiri">
                            <div class="iletisim-ikon-yuvarlagi">
                                <i class="fa-solid fa-building"></i>
                            </div>
                            <div>
                                <div class="small text-muted fw-medium">Şirket Adı</div>
                                <div class="fw-bold text-dark" data-bind="general.company_name">{{ data_get($settings, 'general.company_name', $company->name) }}</div>
                            </div>
                        </div>

                        <div class="iletisim-bilgi-satiri">
                            <div class="iletisim-ikon-yuvarlagi">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <div class="small text-muted fw-medium">Telefon Numarası</div>
                                <div class="fw-bold text-dark" data-bind="general.company_phone">{{ data_get($settings, 'general.company_phone', $company->phone) }}</div>
                            </div>
                        </div>

                        <div class="iletisim-bilgi-satiri">
                            <div class="iletisim-ikon-yuvarlagi">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <div class="small text-muted fw-medium">E-posta Adresi</div>
                                <div class="fw-bold text-dark" data-bind="general.company_email">{{ data_get($settings, 'general.company_email', $company->email) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hızlı Mesaj Formu (Sağ Sütun) -->
                <div class="col-lg-7">
                    <div class="kurumsal-kart">
                        <h4 class="fw-bold text-dark mb-4">
                            <span data-bind="contact.form_title">{{ data_get($settings, 'contact.form_title', 'Hızlı Mesaj Gönder') }}</span>
                        </h4>
                        
                        <form id="canliIletisimFormu" action="/site/{{ $company->slug }}/contact" method="POST" onsubmit="canliFormuGonder(event)">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted fw-medium">
                                        <span data-bind="contact.form_name_label">{{ data_get($settings, 'contact.form_name_label', 'Adınız Soyadınız') }}</span>
                                    </label>
                                    <input type="text" name="name" id="cName" class="form-control form-control-kurumsal" placeholder="Örn: Ahmet Yılmaz">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted fw-medium">
                                        <span data-bind="contact.form_email_label">{{ data_get($settings, 'contact.form_email_label', 'E-posta Adresiniz') }}</span>
                                    </label>
                                    <input type="type" name="email" id="cEmail" class="form-control form-control-kurumsal" placeholder="name@company.com">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-medium">
                                        <span data-bind="contact.form_subject_label">{{ data_get($settings, 'contact.form_subject_label', 'Konu') }}</span>
                                    </label>
                                    <input type="text" name="subject" id="cSubject" class="form-control form-control-kurumsal" placeholder="Mesajınızın konusu nedir?">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-medium">
                                        <span data-bind="contact.form_message_label">{{ data_get($settings, 'contact.form_message_label', 'Mesajınız') }}</span>
                                    </label>
                                    <textarea name="message" id="cMessage" class="form-control form-control-kurumsal" rows="4" placeholder="Mesajınızı buraya yazın..."></textarea>
                                </div>
                                <div class="col-12 text-end mt-4">
                                    <button type="submit" class="btn btn-kurumsal">
                                        <span data-bind="contact.form_submit_button">{{ data_get($settings, 'contact.form_submit_button', 'Mesajı İlet') }}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>