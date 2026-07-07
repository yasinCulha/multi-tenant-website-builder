<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-bind="meta.title">{{ data_get($settings, 'meta.title', $company->name . ' | Resmi Web Sitesi') }}</title>
    
    <!-- CSRF Token (Güvenli AJAX İstekleri İçin Meta Etiketi) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome İkonları -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (Plus Jakarta Sans - Kurumsal ve Modern) -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS (Modern Hata/Başarı Mesaj Kutuları İçin) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --primary-blue: #0f52ba;       /* Saf Kurumsal Mavi */
            --royal-blue: #1e3a8a;         /* Koyu Lacivert / Başlıklar */
            --soft-blue: #f0f5ff;          /* Arka Plan Hafif Mavi Tonu */
            --text-dark: #1e293b;          /* Göz yormayan koyu gri metin */
            --text-muted: #64748b;         /* Yardımcı metin rengi */
            --border-color: #e2e8f0;       /* İnce temiz kenarlıklar */
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc; 
            color: var(--text-dark);
            line-height: 1.6;
            scroll-behavior: smooth;
        }

        /* ÜST MENÜ (NAVBAR) */
        .kurumsal-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 18px 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--royal-blue) !important;
            font-size: 22px;
            letter-spacing: -0.5px;
        }

        .navbar-brand i {
            color: var(--primary-blue);
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            padding: 8px 16px !important;
            transition: all 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-blue) !important;
        }

        /* HERO BÖLÜMÜ (GİRİŞ ALANI) */
        .hero-section {
            background: linear-gradient(135deg, var(--soft-blue) 0%, #ffffff 100%);
            padding: 120px 0;
            border-bottom: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .hero-badge {
            background-color: rgba(15, 82, 186, 0.1);
            color: var(--primary-blue);
            padding: 6px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 48px;
            font-weight: 700;
            color: var(--royal-blue);
            letter-spacing: -1px;
            margin-bottom: 20px;
        }

        .hero-desc {
            color: var(--text-muted);
            font-size: 18px;
            margin-bottom: 35px;
            max-width: 550px;
        }

        /* GENEL BÖLÜM AYARLARI */
        .section-padding {
            padding: 90px 0;
        }

        .section-title {
            font-size: 34px;
            font-weight: 700;
            color: var(--royal-blue);
            margin-bottom: 15px;
        }

        /* KARTLAR */
        .kurumsal-kart {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 35px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.02);
        }

        .kurumsal-kart:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(15, 82, 186, 0.08);
            border-color: rgba(15, 82, 186, 0.2);
        }

        .kart-ikon {
            width: 60px;
            height: 60px;
            background-color: var(--soft-blue);
            color: var(--primary-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 25px;
            transition: all 0.3s;
        }

        .kurumsal-kart:hover .kart-ikon {
            background-color: var(--primary-blue);
            color: #ffffff;
        }

        /* HAKKIMIZDA BÖLÜMÜ */
        .hakkimizda-section {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
        }

        .istatistik-kutusu {
            text-align: center;
            padding: 20px;
        }

        .istatistik-sayi {
            font-size: 42px;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 5px;
        }

        /* İLETİŞİM BÖLÜMÜ */
        .iletisim-section {
            background-color: var(--soft-blue);
        }

        .iletisim-bilgi-satiri {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .iletisim-ikon-yuvarlagi {
            width: 45px;
            height: 45px;
            background-color: #ffffff;
            color: var(--primary-blue);
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .form-control-kurumsal {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            padding: 12px 16px;
            border-radius: 8px;
            color: var(--text-dark);
        }

        .form-control-kurumsal:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(15, 82, 186, 0.1);
            outline: none;
        }

        /* BUTONLAR */
        .btn-kurumsal {
            background-color: var(--primary-blue);
            color: #ffffff;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 8px;
            border: none;
            transition: all 0.2s;
        }

        .btn-kurumsal:hover {
            background-color: #0d439c;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(15, 82, 186, 0.3);
        }

        .btn-kurumsal-outline {
            background-color: transparent;
            color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
            font-weight: 600;
            padding: 10px 26px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-kurumsal-outline:hover {
            background-color: var(--soft-blue);
            color: var(--primary-blue);
        }

        /* FOOTER */
        .kurumsal-footer {
            background-color: #0f172a; 
            color: #94a3b8;
            padding: 50px 0;
        }
    </style>
</head>
<body>

    <!-- ÜST MENÜ (NAVBAR) -->
    <nav class="navbar navbar-expand-lg kurumsal-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ data_get($settings, 'general.company_website', '#') }}" data-bind-href="general.company_website">
                <i class="fa-solid fa-briefcase"></i>
                <span data-bind="general.company_name">{{ data_get($settings, 'general.company_name', $company->name) }}</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars fs-4 text-dark"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_home_url', '#') }}" data-bind-href="navbar.nav_home_url">
                            <span data-bind="navbar.nav_home">{{ data_get($settings, 'navbar.nav_home', 'Ana Sayfa') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_services_url', '#hizmetler') }}" data-bind-href="navbar.nav_services_url">
                            <span data-bind="navbar.nav_services">{{ data_get($settings, 'navbar.nav_services', 'Hizmetlerimiz') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_about_url', '#hakkimizda') }}" data-bind-href="navbar.nav_about_url">
                            <span data-bind="navbar.nav_about">{{ data_get($settings, 'navbar.nav_about', 'Hakkımızda') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_contact_url', '#iletisim') }}" data-bind-href="navbar.nav_contact_url">
                            <span data-bind="navbar.nav_contact">{{ data_get($settings, 'navbar.nav_contact', 'İletişim') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO GİRİŞ BÖLÜMÜ -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="hero-badge">
                        <i class="fa-solid fa-sparkles me-1"></i>
                        <span data-bind="hero.badge_text">{{ data_get($settings, 'hero.badge_text', 'Kurumsal Çözümler') }}</span>
                    </span>
                    <h1 class="hero-title" id="heroTitlePreview"  data-bind="hero.styles.title_color" data-bind-style="color"style="color:{{ data_get($settings,'hero.styles.title_color','#4169E1') }}">
                        <span data-bind="hero.title">{{ data_get($settings, 'hero.title', 'İşinizi Dijital Dünyada Güvenle Büyütün') }}</span>
                    </h1>
                    <p class="hero-desc" id="heroDescriptionPreview">
                        <span data-bind="hero.description">{{ data_get($settings, 'hero.description', 'Bu varsayılan açıklamadır.') }}</span>
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ data_get($settings, 'hero.button_primary_url', '#iletisim') }}" data-bind-href="hero.button_primary_url" class="btn btn-kurumsal text-decoration-none shadow-sm" id="heroButtonPreview">
                            <span data-bind="hero.button_primary_text">{{ data_get($settings, 'hero.button_primary_text', 'Hemen Başlayın') }}</span>
                        </a>
                        <a href="{{ data_get($settings, 'hero.button_secondary_url', '#hakkimizda') }}" data-bind-href="hero.button_secondary_url" class="btn btn-kurumsal-outline text-decoration-none" id="aboutButtonPreview">
                            <span data-bind="hero.button_secondary_text">{{ data_get($settings, 'hero.button_secondary_text', 'Bizi Tanıyın') }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-end">
                    <i class="fa-solid fa-chart-line" style="font-size: 280px; color: rgba(15, 82, 186, 0.05);"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- HİZMETLER BÖLÜMÜ -->
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

    <!-- HAKKIMIZDA BÖLÜMÜ -->
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

    <!-- İLETİŞİM BÖLÜMÜ -->
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

    <!-- FOOTER ALANI -->
    <footer class="kurumsal-footer bg-dark text-light py-5 border-top border-secondary">
        <div class="container">
            {{-- Üst Kısım: Firma Adı --}}
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h5 class="text-white fw-bold mb-2 tracking-wide text-uppercase" style="letter-spacing: 1px;" data-bind="general.company_name">
                        {{ var_export(data_get($settings, 'general.company_name', $company->name), true) ? data_get($settings, 'general.company_name', $company->name) : $company->name }}
                    </h5>
                    <p class="m-0 text-gray">
                        <span data-bind="footer.copyright_text">{{ data_get($settings, 'footer.copyright_text', '© 2026 Tüm Hakları Saklıdır. Güvenli Kurumsal Altyapı Çözümleri.') }}</span>
                    </p>
                    <div class="mx-auto bg-primary" style="width: 50px; height: 3px; border-radius: 2px;"></div>
                </div>
            </div>
        
            {{-- Orta Kısım: Sosyal Medya ve İletişim Bilgileri --}}
            <div class="row g-4 justify-content-center align-items-start my-3">
                
                {{-- SOSYAL MEDYA SÜTUNU --}}
                @if($company->socialMedias && $company->socialMedias->isNotEmpty())
                    <div class="col-md-5 text-center text-md-end border-end-md border-secondary pe-md-4">
                        <span class="text-muted d-block small text-uppercase fw-bold mb-3" style="letter-spacing: 0.5px;" data-bind="footer.social_title">
                            {{ data_get($settings, 'footer.social_title', 'Sosyal Medya Hesaplarımız') }}
                        </span>
                        <div class="d-flex gap-2 justify-content-center justify-content-md-end flex-wrap">
                            @foreach($company->socialMedias as $index => $social)
                                <a href="{{ data_get($settings, "footer.social_media.$index.url", $social->url) }}" 
                                   data-bind="footer.social_media.{{ $index }}.url"
                                   data-bind-attr="href"
                                   target="_blank" 
                                   class="btn btn-outline-light btn-sm rounded-circle d-inline-flex align-items-center justify-content-center" 
                                   style="width: 38px; height: 38px;">
                                   
                                    @if($social->platform == 'instagram')
                                        <i class="fa-brands fa-instagram fs-5"></i>
                                    @elseif($social->platform == 'twitter' || $social->platform == 'x')
                                        <i class="fa-brands fa-x fs-5"></i>
                                    @elseif($social->platform == 'linkedin')
                                        <i class="fa-brands fa-linkedin-in fs-5"></i>
                                    @elseif($social->platform == 'youtube')
                                        <i class="fa-brands fa-youtube fs-5"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- İLETİŞİM NUMARALARI SÜTUNU --}}
                @if($company->phones && $company->phones->isNotEmpty())
                    <div class="col-md-5 text-center text-md-start ps-md-4">
                        <span class="text-muted d-block small text-uppercase fw-bold mb-3" style="letter-spacing: 0.5px;" data-bind="footer.contact_title">
                            {{ data_get($settings, 'footer.contact_title', 'İletişim Numaralarımız') }}
                        </span>
                        <div class="d-flex flex-column gap-2 align-items-center align-items-md-start">
                            @foreach($company->phones as $index => $phone)
                                @if($phone->type == 'cep')
                                    <p class="text-light text-decoration-none d-flex align-items-center gap-2 link-primary-hover m-0">
                                        <i class="fa-solid fa-mobile-screen-button text-primary"></i> 
                                        <span>
                                            <strong data-bind="footer.phone.{{ $index }}.type">{{ data_get($settings, "footer.phone.$index.type", 'Cep') }}:</strong> 
                                            <span data-bind="footer.phone.{{ $index }}.number">{{ data_get($settings, "footer.phone.$index.number", $phone->number) }}</span>
                                        </span>
                                    </p>
                                @elseif($phone->type == 'sabit')
                                    <p class="text-light text-decoration-none d-flex align-items-center gap-2 link-primary-hover m-0">
                                        <i class="fa-solid fa-phone text-primary"></i> 
                                        <span>
                                            <strong data-bind="footer.phone.{{ $index }}.type">{{ data_get($settings, "footer.phone.$index.type", 'Sabit Hat') }}:</strong> 
                                            <span data-bind="footer.phone.{{ $index }}.number">{{ data_get($settings, "footer.phone.$index.number", $phone->number) }}</span>
                                        </span>
                                    </p>
                                @elseif($phone->type == 'whatsapp')
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', data_get($settings, "footer.phone.$index.number", $phone->number)) }}" 
                                       data-bind="footer.phone.{{ $index }}.number"
                                       data-bind-attr="href"
                                       target="_blank" 
                                       class="text-light text-decoration-none d-flex align-items-center gap-2 link-success-hover">
                                        <i class="fa-brands fa-whatsapp text-success fs-5"></i> 
                                        <span>
                                            <strong data-bind="footer.phone.{{ $index }}.type">{{ data_get($settings, "footer.phone.$index.type", 'WhatsApp') }}:</strong> 
                                            <span>{{ data_get($settings, "footer.phone.$index.number", $phone->number) }}</span>
                                        </span>
                                    </a>
                                @elseif($phone->type == 'destek')
                                    <p class="text-light text-decoration-none d-flex align-items-center gap-2 link-primary-hover m-0">
                                        <i class="fa-solid fa-headset text-primary"></i> 
                                        <span>
                                            <strong data-bind="footer.phone.{{ $index }}.type">{{ data_get($settings, "footer.phone.$index.type", 'Destek') }}:</strong> 
                                            <span data-bind="footer.phone.{{ $index }}.number">{{ data_get($settings, "footer.phone.$index.number", $phone->number) }}</span>
                                        </span>
                                    </p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <hr class="border-secondary my-4">

            {{-- Alt Kısım: Copyright --}}
            <div class="row">
                <div class="col-12 text-center">
                    <p class="m-0 text-muted small">
                        <span data-bind="footer.copyright_subtext">{{ data_get($settings, 'footer.copyright_subtext', '© 2026 Tüm Hakları Saklıdır. Güvenli Kurumsal Altyapı Çözümleri.') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <style>
        .kurumsal-footer a {
            transition: all 0.3s ease;
        }
        .kurumsal-footer .btn-outline-light:hover {
            background-color: #fff;
            color: #212529 !important;
            transform: translateY(-2px);
        }
        .link-primary-hover:hover {
            color: #0d6efd !important;
        }
        .link-success-hover:hover {
            color: #198754 !important;
        }
        @media (min-width: 768px) {
            .border-end-md {
                border-end: 1px solid #495057 !important;
            }
        }
    </style>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JavaScript CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- FETCH API İLE SAYFA YENİLEMEDEN VALIDASYONLU GÖNDERİM SCRIPT'I -->
    <script>
    function canliFormuGonder(event) {
        event.preventDefault(); 

        const form = document.getElementById('canliIletisimFormu');
        const postUrl = form.getAttribute('action'); 

        const formData = {
            name: document.getElementById('cName').value,
            email: document.getElementById('cEmail').value,
            subject: document.getElementById('cSubject').value,
            message: document.getElementById('cMessage').value
        };

        const token = document.querySelector('input[name="_token"]').value;

        fetch(postUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json', 
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Başarılı!',
                text: data.message, 
                confirmButtonColor: '#0f52ba'
            });
            form.reset(); 
        })
        .catch(error => {
            console.error(error);
            
            let hataListesi = '';
            if (error.errors) {
                hataListesi = Object.values(error.errors).flat().join('<br>');
            } else {
                hataListesi = error.message || 'Sistemsel bir bağlantı hatası oluştu knk.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Eksik veya Hatalı Giriş!',
                html: `<div class="text-start text-danger" style="font-size:14px; font-weight:500;">${hataListesi}</div>`,
                confirmButtonColor: '#0f52ba'
            });
        });
    }
    </script>
</body>
</html>