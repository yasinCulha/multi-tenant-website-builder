<section id="iletisim" class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-white" >
                    <span data-bind="contact.section_title" >
                        {{ data_get($settings,'contact.section_title','Bizimle İletişime Geçin') }}
                    </span>
                </h2>
                <p class="text-gray" data-bind="contact.section_subtitle">
                    <span data-bind="contact.section_subtitle">
                        {{ data_get($settings,'contact.section_subtitle','Projeniz mi var? Formu doldurun, uzman ekibimiz en kısa sürede dönüş sağlasın.') }}
                    </span>
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="p-4 p-md-5 rounded-4 border border-secondary shadow-lg" style="background-color: #111827;">
                        
                        <form id="canliIletisimFormuDark" action="/site/{{ $company->slug }}/contact" method="POST" onsubmit="darkFormuGonder(event)">
                            @csrf 
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label text-light fw-medium small" >
                                        <span data-bind="contact.form_name_label">
                                            {{ data_get($settings,'contact.form_name_label','Adınız Soyadınız') }}
                                        </span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" 
                                            name="name" 
                                            id="dName" 
                                            class="form-control bg-dark border-secondary text-light custom-input" 
                                            placeholder="Örn: Yasin Culha"
                                            oninput="this.value = this.value.replace(/[0-9]/g, '')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-light fw-medium small" >
                                        <span data-bind="contact.form_email_label">
                                            {{ data_get($settings,'contact.form_email_label','E-Posta Adresiniz') }}
                                        </span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-envelope"></i></span>
                                        <input type="email" 
                                            name="email" 
                                            id="dEmail" 
                                            class="form-control bg-dark border-secondary text-light custom-input" 
                                            placeholder="isim@firma.com">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-light fw-medium small" >
                                        <span data-bind="contact.form_subject_label">
                                            {{ data_get($settings,'contact.form_subject_label','Mesaj Konusu') }}
                                        </span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-circle-info"></i></span>
                                        <input type="text" 
                                            name="subject" 
                                            id="dSubject" 
                                            class="form-control bg-dark border-secondary text-light custom-input" 
                                            placeholder="Hangi konuda görüşmek istersiniz?">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-light fw-medium small" >
                                        <span data-bind="contact.form_message_label">
                                            {{ data_get($settings,'contact.form_message_label','Mesajınız') }}
                                        </span>
                                    </label>
                                    <textarea name="message" 
                                        id="dMessage" 
                                        class="form-control bg-dark border-secondary text-light custom-input placeholder-gray" 
                                        rows="5" 
                                        placeholder="Projeniz veya sorunuz hakkında detaylı bilgi yazın..."></textarea>
                                </div>

                                <div class="col-12 text-end">
                                    <button
                                        type="submit"
                                        class="btn btn-primary px-5 py-3 fw-semibold w-100 w-md-auto"
                                        style="background-color:#6366f1;border:none;border-radius:10px;">

                                        <i class="fa-solid fa-paper-plane me-2"></i>

                                        <span data-bind="contact.form_submit_button">
                                            {{ data_get($settings,'contact.form_submit_button','Talebi Gönder') }}
                                        </span>

                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>