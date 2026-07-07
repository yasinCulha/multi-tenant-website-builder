<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-bind="meta.title">{{ data_get($settings, 'meta.title', $company->name . ' | Resmi Web Sitesi') }}</title>
    
    <!-- CSRF Token Metası -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        /* Gerçekçi Cyberpunk/Karanlık Tema Renk Paleti */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #030712; /* Derin uzay siyahı */
            color: #9ca3af; /* Yumuşak gri metinler */
            scroll-behavior: smooth;
        }

        /* GERÇEKÇİ NAVBAR (ÜST MENÜ) */
        .modern-karanlik-navbar {
            background-color: rgba(17, 24, 39, 0.8) !important; /* Yarı şeffaf koyu gri */
            backdrop-filter: blur(10px); /* Arkadaki içeriği flulaştıran premium efekt */
            border-bottom: 1px solid #1f2937;
        }

        .navbar-brand-text {
            font-weight: 700;
            color: #6366f1 !important; /* Mor vurgu rengi */
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-link {
            color: #d1d5db !important;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: #6366f1 !important; /* Üzerine gelince mor olsun */
        }

        /* HERO BÖLÜMÜ (ANA KARŞILAMA ALANI) */
        .hero-bölümü {
            padding: 140px 0 100px 0;
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent 50%);
        }

        .hero-baslik {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.2;
        }

        /* GRADYAN METİN: Yazılım firmalarında çok popüler olan renkli yazı efekti */
        .renkli-gradyan-yazi {
            background: linear-gradient(135deg, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* HİZMETLER / ÖZELLİKLER KARTLARI */
        .hizmet-karti {
            background-color: #111827;
            border: 1px solid #1f2937;
            border-radius: 16px;
            padding: 30px;
            transition: all 0.3s ease-in-out;
        }

        .hizmet-karti:hover {
            transform: translateY(-5px);
            border-color: #6366f1;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.1);
        }

        .hizmet-ikonu {
            width: 50px;
            height: 50px;
            background-color: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
        }
        /* Form inputlarına odaklanıldığında (Focus) mor parlama efekti */
        .custom-input:focus {
            background-color: #1f2937 !important;
            border-color: #6366f1 !important;
            color: #ffffff !important;
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.25) !important;
            outline: none;
        }

        /* FOOTER (ALT BİLGİ ALANI) */
        footer {
            background-color: #111827;
            border-top: 1px solid #1f2937;
            padding: 40px 0;
            margin-top: 100px;
        }
        ::placeholder {
            color: #6b7280 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg modern-karanlik-navbar fixed-top py-3">
        <div class="container">
            <a class="navbar-brand navbar-brand-text" href="{{ data_get($settings, 'general.company_website') }}" data-bind="general.company_name">
                <i class="fa-solid fa-terminal me-2"></i>{{ $company->name }}
            </a>
            
            <button class="navbar-toggler border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarIcerik">
                <span class="navbar-toggler-icon text-light"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarIcerik">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ data_get($settings, 'navbar.nav_home_url', '#ana-sayfa') }}"
                            data-bind-href="navbar.nav_home_url">

                            <span data-bind="navbar.nav_home">
                                {{ data_get($settings, 'navbar.nav_home', 'Ana Sayfa') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" 
                            href="{{ data_get($settings, 'navbar.nav_services_url', '#hizmetler') }}" 
                            data-bind-href="navbar.nav_services_url">
                            <span data-bind="navbar.nav_services">
                                {{ data_get($settings, 'navbar.nav_services', 'Hizmetler') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_about_url', '#hakkimizda') }}" data-bind-href="navbar.nav_about_url">
                            <span data-bind="navbar.nav_about">
                                {{ data_get($settings, 'navbar.nav_about', 'Hakkımızda') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_contact_url', '#iletisim') }}" data-bind-href="navbar.nav_contact_url">
                            <span data-bind="navbar.nav_contact">
                                {{ data_get($settings, 'navbar.nav_contact', 'İletişim') }}
                            </span>
                        </a>
                    </li>
                </ul>
                <a
                    href="{{ data_get($settings, 'navbar.cta_button_url', 'https://wa.me/' . $company->whatsapp_number) }}"
                    data-bind="navbar.cta_button_url"
                    data-bind-attr="href"
                    class="btn btn-primary btn-sm ms-lg-3 px-4 py-2 fw-semibold"
                    style="background-color: #6366f1; border: none; border-radius: 8px;">

                    <span data-bind="navbar.cta_button_text">
                        {{ data_get($settings, 'navbar.cta_button_text', 'Teklif Al') }}
                    </span>

                </a>
            </div>
        </div>
    </nav>

    <section id="ana-sayfa" class="hero-bölümü">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="hero-baslik text-white mb-4">
                        <span data-bind="hero.title_prefix">
                            {{ data_get($settings,'hero.title_prefix','Geleceğin Teknolojisini') }}
                        </span>
                        <br>
                        <span class="renkli-gradyan-yazi" data-bind="hero.company_name">
                            {{ data_get($settings,'hero.company_name',$company->name) }}
                        </span>

                        <span data-bind="hero.title_suffix">
                            {{ data_get($settings,'hero.title_suffix','İle İnşa Edin') }}
                        </span>
                    </h1>
                    <p class="fs-5 mb-4 text-secondary">
                        <span data-bind="hero.description">
                            {{ data_get($settings,'hero.description','Yapabilirliklerinizi veri analitiği ve modern web mimarileriyle ölçeklendirin. Sizin için en stabil çözümleri üretiyoruz.') }}
                        </span>
                    </p>
                    <div class="d-flex gap-3">
                        <a
                            href="{{ data_get($settings,'hero.button_primary_url','#hizmetler') }}"
                            data-bind="hero.button_primary_url"
                            data-bind-attr="href"
                            class="btn btn-primary px-4 py-3 fw-semibold"
                            style="background-color:#6366f1;border:none;border-radius:10px;">

                            <span data-bind="hero.button_primary_text">
                                {{ data_get($settings,'hero.button_primary_text','Çözümlerimizi İnceleyin') }}
                            </span>

                        </a>
                        <a href="{{ data_get($settings,'hero.button_secondary_url','#iletisim') }}"
                            data-bind="hero.button_secondary_url"
                            data-bind-attr="href"
                            class="btn btn-outline-secondary text-light px-4 py-3 fw-semibold"
                            style="border-radius:10px;">

                            <span data-bind="hero.button_secondary_text">
                                {{ data_get($settings,'hero.button_secondary_text','Bizimle Tanışın') }}
                            </span>

                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fa-solid fa-laptop-code text-indigo d-none d-lg-block" style="font-size: 280px; color: rgba(99, 102, 241, 0.15);"></i>
                </div>
            </div>
        </div>
    </section>

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

    <section id="hakkimizda" class="py-5" style="background: linear-gradient(180deg, #030712 0%, #0b0f19 100%);">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="p-5 bg-dark rounded-4 border border-secondary text-center" style="background-color: #111827 !important;">
                        <i class="fa-solid fa-users-gear text-indigo" style="font-size: 120px; color: #6366f1;"></i>
                        <h3 class="text-white fw-bold mt-4">
                            <span data-bind="about.badge_title">
                                {{ data_get($settings,'about.badge_title','Uçtan Uca Yönetim') }}
                            </span>
                        </h3>
                        <p class="small text-muted m-0">
                            <span data-bind="about.badge_desc">
                                {{ data_get($settings,'about.badge_desc','Deneyimli kadromuzla tüm dijital altyapınızı tek merkezden yönetiyoruz.') }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="text-uppercase fw-bold text-indigo tracking-wider" style="color: #6366f1; font-size: 14px;" data-bind="about.section_tag">
                        {{ data_get($settings,'about.section_tag','Biz Kimiz?') }}
                    </span>
                    <h2 class="fw-bold text-white mt-2 mb-4">
                        <span data-bind="about.section_title">
                            {{ data_get($settings,'about.section_title','Teknoloji Dünyasında Güvenilir Çözüm Ortağınız') }}
                        </span>
                    </h2>
                    <p class="text-secondary mb-3">
                        <strong>
                            <span data-bind="general.company_name">
                                {{ data_get($settings,'general.company_name',$company->name) }}
                            </span>
                        </strong>
                        <span data-bind="about.text_p1">
                            {{ data_get($settings,'about.text_p1','olarak kurulduğumuz günden bu yana, işletmelerin dijital çağın getirdiği zorlukları aşmalarını ve teknolojik dönüşümlerini en sorunsuz şekilde tamamlamalarını sağlıyoruz.') }}
                        </span>
                    </p>
                    <p class="text-secondary mb-4" data-bind="about.text_p2">
                        {{ data_get($settings,'about.text_p2','Junior geliştiricilerimizin temiz kod vizyonu ve senior mimarlarımızın kararlı altyapı seçimleri sayesinde, projenizin gelecekte de ölçeklenebilir kalacağını garanti ediyoruz.') }}
                    </p>
                    
                    <div class="d-flex gap-4">
                        <div>
                            <h3 class="fw-bold text-white m-0">
                                <span data-bind="about.stat_1_value">
                                {{ data_get($settings,'about.stat_1_value','100+') }}
                                </span>
                            </h3>
                            <span class="small text-gray">
                                <span data-bind="about.stat_1_label">
                                {{ data_get($settings,'about.stat_1_label','Tamamlanan Proje') }}
                                </span>
                            </span>
                        </div>
                        <div class="border-start border-secondary ps-4">
                            <h3 class="fw-bold text-white m-0" data-bind="about.stat_2_value">
                                {{ data_get($settings,'about.stat_2_value','50+') }}
                            </h3>
                            <span class="small text-gray" data-bind="about.stat_2_label">
                                {{ data_get($settings,'about.stat_2_label','Mutlu Kurumsal Müşteri') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <footer class="py-5" style="background:#111827; border-top:1px solid #374151;">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-white">
                    <span data-bind="general.company_name">
                        {{ $company->name }}
                    </span>
                </h3>
            </div>
            <div class="row g-4">

                {{-- Sosyal Medya --}}
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 h-100" style="background:#1f2937;">
                        <h5 class="text-success mb-4">
                            <i class="fa-solid fa-share-nodes me-2"></i>
                            <span data-bind="footer.social_title">
                                Sosyal Medya
                            </span>
                        </h5>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($company->socialMedias as $index => $social)
                                <a
                                    href="{{ data_get($settings, "footer.social_media.$index.url", $social->url) }}"
                                    data-bind="footer.social_media.{{ $index }}.url"
                                    data-bind-attr="href"
                                    target="_blank"
                                    class="d-flex align-items-center justify-content-center rounded-circle text-white text-decoration-none"
                                    style="width:50px;height:50px;background:#374151;transition:.3s;">

                                    @if($social->platform=="instagram")
                                        <i class="fa-brands fa-instagram fs-4"></i>
                                    @elseif($social->platform=="x")
                                        <i class="fa-brands fa-x fs-4"></i>
                                    @elseif($social->platform=="linkedin")
                                        <i class="fa-brands fa-linkedin fs-4"></i>
                                    @elseif($social->platform=="youtube")
                                        <i class="fa-brands fa-youtube fs-4"></i>
                                    @endif

                                </a>

                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Telefonlar --}}
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 h-100" style="background:#1f2937;">
                        <h5 class="text-success mb-4">
                            <i class="fa-solid fa-phone me-2"></i>
                            <span data-bind="footer.contact_title">
                                İletişim
                            </span>
                        </h5>
                        @foreach($company->phones as $index => $phone)
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    @if($phone->type=="cep")
                                        <i class="fa-solid fa-mobile-screen-button text-success fs-5"></i>
                                    @elseif($phone->type=="sabit")
                                        <i class="fa-solid fa-phone text-success fs-5"></i>
                                    @elseif($phone->type=="whatsapp")
                                        <i class="fa-brands fa-whatsapp text-success fs-5"></i>
                                    @else
                                        <i class="fa-solid fa-headset text-success fs-5"></i>
                                    @endif
                                </div>

                                <div>
                                    <div class="text-secondary small">
                                        <span data-bind="footer.phone.{{ $index }}.type">
                                            {{ data_get($settings,"footer.phone.$index.type", ucfirst($phone->type)) }}
                                        </span>
                                    </div>

                                    @if($phone->type=="whatsapp")
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone->number) }}"
                                            target="_blank" 
                                            class="text-white text-decoration-none"
                                            data-bind="footer.phone.{{ $index }}.number">
                                            {{$phone->number}}
                                        </a>
                                    @else
                                        <p class="text-white text-decoration-none m-0" data-bind="footer.phone.{{ $index }}.number">
                                            {{$phone->number}}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr class="my-5 border-secondary">
            <div class="text-center text-secondary small">
                <span data-bind="footer.copyright_text">
                {{ data_get($settings,'footer.copyright_text','© 2026 Tüm Hakları Saklıdır. Güvenli Kurumsal Altyapı Çözümleri.') }}
                </span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- ASENKRON FORMU GÖNDEREN CODES -->
    <script>
    function darkFormuGonder(event) {
        event.preventDefault(); 

        const form = document.getElementById('canliIletisimFormuDark');
        const postUrl = form.getAttribute('action'); 

        const formData = {
            name: document.getElementById('dName').value,
            email: document.getElementById('dEmail').value,
            subject: document.getElementById('dSubject').value,
            message: document.getElementById('dMessage').value
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
                confirmButtonColor: '#6366f1'
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
                confirmButtonColor: '#6366f1'
            });
        });
    }
    </script>
</body>
</html>