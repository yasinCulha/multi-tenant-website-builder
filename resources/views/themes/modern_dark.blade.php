<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $company->name }} | Resmi Web Sitesi</title>
    
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
            <a class="navbar-brand navbar-brand-text" href="#">
                <i class="fa-solid fa-terminal me-2"></i>{{ $company->name }}
            </a>
            
            <button class="navbar-toggler border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarIcerik">
                <span class="navbar-toggler-icon text-light"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarIcerik">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                    <li class="nav-item"><a class="nav-link" href="#ana-sayfa">Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#hizmetler">Hizmetler</a></li>
                    <li class="nav-item"><a class="nav-link" href="#hakkimizda">Hakkımızda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#iletisim">İletişim</a></li>
                </ul>
                <a href="https://wa.me/{{ $company->whatsapp_number }}" class="btn btn-primary btn-sm ms-lg-3 px-4 py-2 fw-semibold" style="background-color: #6366f1; border: none; border-radius: 8px;">
                    Teklif Al
                </a>
            </div>
        </div>
    </nav>

    <section id="ana-sayfa" class="hero-bölümü">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge bg-dark border border-secondary text-light px-3 py-2 rounded-pill mb-3 fw-medium">
                        🚀 Dijital Dönüşüm Başladı
                    </span>
                    <h1 class="hero-baslik text-white mb-4">
                        Geleceğin Teknolojisini <br>
                        <span class="renkli-gradyan-yazi">{{ $company->name }}</span> İle İnşa Edin
                    </h1>
                    <p class="fs-5 mb-4 text-secondary">
                        Yapabilirliklerinizi veri analitiği ve modern web mimarileriyle ölçeklendirin. Sizin için en stabil çözümleri üretiyoruz.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#hizmetler" class="btn btn-primary px-4 py-3 fw-semibold" style="background-color: #6366f1; border: none; border-radius: 10px;">
                            Çözümlerimizi İnceleyin
                        </a>
                        <a href="#iletisim" class="btn btn-outline-secondary text-light px-4 py-3 fw-semibold" style="border-radius: 10px;">
                            Bizimle Tanışın
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
                <h2 class="fw-bold text-white">Neler Yapıyoruz?</h2>
                <p class="text-gray">İhtiyaçlarınıza özel uçtan uca modern yazılım çözümleri</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="hizmet-karti h-100">
                        <div class="hizmet-ikonu"><i class="fa-solid fa-code"></i></div>
                        <h5 class="text-white fw-bold mb-3">Özel Web Yazılımları</h5>
                        <p class="small text-secondary m-0">Yüksek performanslı, SEO uyumlu ve her ekrana tam oturan modern web uygulamaları geliştiriyoruz.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hizmet-karti h-100">
                        <div class="hizmet-ikonu"><i class="fa-solid fa-brain"></i></div>
                        <h5 class="text-white fw-bold mb-3">Yapay Zeka & Veri</h5>
                        <p class="small text-secondary m-0">Verilerinizi anlamlı raporlara dönüştürüyor, iş süreçlerinizi otomatize edecek AI modelleri kuruyoruz.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hizmet-karti h-100">
                        <div class="hizmet-ikonu"><i class="fa-solid fa-shield-halved"></i></div>
                        <h5 class="text-white fw-bold mb-3">Siber Güvenlik</h5>
                        <p class="small text-secondary m-0">Sistemlerinizin güvenliğini en üst seviyede tutmak için sızma testleri ve veri güvenliği optimizasyonları yapıyoruz.</p>
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
                        <h3 class="text-white fw-bold mt-4">Uçtan Uca Yönetim</h3>
                        <p class="small text-muted m-0">Deneyimli kadromuzla tüm dijital altyapınızı tek merkezden yönetiyoruz.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="text-uppercase fw-bold text-indigo tracking-wider" style="color: #6366f1; font-size: 14px;">Biz Kimiz?</span>
                    <h2 class="fw-bold text-white mt-2 mb-4">Teknoloji Dünyasında Güvenilir Çözüm Ortağınız</h2>
                    <p class="text-secondary mb-3">
                        <strong>{{ $company->name }}</strong> olarak kurulduğumuz günden bu yana, işletmelerin dijital çağın getirdiği zorlukları aşmalarını ve teknolojik dönüşümlerini en sorunsuz şekilde tamamlamalarını sağlıyoruz.
                    </p>
                    <p class="text-secondary mb-4">
                        Junior geliştiricilerimizin temiz kod vizyonu ve senior mimarlarımızın kararlı altyapı seçimleri sayesinde, projenizin gelecekte de ölçeklenebilir kalacağını garanti ediyoruz.
                    </p>
                    
                    <div class="d-flex gap-4">
                        <div>
                            <h3 class="fw-bold text-white m-0">100+</h3>
                            <span class="small text-muted">Tamamlanan Proje</span>
                        </div>
                        <div class="border-start border-secondary ps-4">
                            <h3 class="fw-bold text-white m-0">50+</h3>
                            <span class="small text-muted">Mutlu Kurumsal Müşteri</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="iletisim" class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-white">Bizimle İletişime Geçin</h2>
                <p class="text-gray">Projeniz mi var? Formu doldurun, uzman ekibimiz en kısa sürede dönüş sağlasın.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="p-4 p-md-5 rounded-4 border border-secondary shadow-lg" style="background-color: #111827;">
                        
                        <!-- ID eklendi ve onsubmit olayı JavaScript fonksiyonumuza bağlandı knk -->
                        <form id="canliIletisimFormuDark" action="/site/{{ $company->slug }}/contact" method="POST" onsubmit="darkFormuGonder(event)">
                            @csrf 
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label text-light fw-medium small">Adınız Soyadınız</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-user"></i></span>
                                        <!-- name, id, oninput (canlı sayı engelleme) alanları senkronize edildi -->
                                        <input type="text" 
                                            name="name" 
                                            id="dName" 
                                            class="form-control bg-dark border-secondary text-light custom-input" 
                                            placeholder="Örn: Yasin Culha"
                                            oninput="this.value = this.value.replace(/[0-9]/g, '')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-light fw-medium small">E-Posta Adresiniz</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-envelope"></i></span>
                                        <!-- name ve id eksikti eklendi -->
                                        <input type="email" 
                                            name="email" 
                                            id="dEmail" 
                                            class="form-control bg-dark border-secondary text-light custom-input" 
                                            placeholder="isim@firma.com">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-light fw-medium small">Mesaj Konusu</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-circle-info"></i></span>
                                        <!-- name ve id eksikti eklendi -->
                                        <input type="text" 
                                            name="subject" 
                                            id="dSubject" 
                                            class="form-control bg-dark border-secondary text-light custom-input" 
                                            placeholder="Hangi konuda görüşmek istersiniz?">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-light fw-medium small">Mesajınız</label>
                                    <!-- name ve id eksikti eklendi -->
                                    <textarea name="message" 
                                        id="dMessage" 
                                        class="form-control bg-dark border-secondary text-light custom-input placeholder-gray" 
                                        rows="5" 
                                        placeholder="Projeniz veya sorunuz hakkında detaylı bilgi yazın..."></textarea>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary px-5 py-3 fw-semibold w-100 w-md-auto" style="background-color: #6366f1; border: none; border-radius: 10px;">
                                        <i class="fa-solid fa-paper-plane me-2"></i> Talebi Gönder
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
    <footer class="py-5" style="background:#111827; border-top:1px solid #374151;">
        <div class="container">
                <div class="text-center mb-5">
                    <h3 class="fw-bold text-white">
                        {{ $company->name }}
                    </h3>
                </div>
                <div class="row g-4">

                    {{-- Sosyal Medya --}}
                    <div class="col-lg-6">
                        <div class="p-4 rounded-4 h-100"
                            style="background:#1f2937;">
                            <h5 class="text-success mb-4">
                                <i class="fa-solid fa-share-nodes me-2"></i>
                                Sosyal Medya
                            </h5>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($company->socialMedias as $social)
                                    <a href="{{ $social->url }}"
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
                        <div class="p-4 rounded-4 h-100"
                            style="background:#1f2937;">
                            <h5 class="text-success mb-4">

                                <i class="fa-solid fa-phone me-2"></i>
                                İletişim
                            </h5>
                            @foreach($company->phones as $phone)
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
                                            {{ ucfirst($phone->type) }}
                                        </div>

                                        @if($phone->type=="whatsapp")
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone->number) }}"
                                                target="_blank" 
                                                class="text-white text-decoration-none">
                                                {{$phone->number}}
                                            </a>
                                        @else
                                            <p class="text-white text-decoration-none">
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
                © 2026 Tüm Hakları Saklıdır. Güvenli Kurumsal Altyapı Çözümleri.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ASENKRON FORMU GÖNDEREN CODES -->
    <script>
    function darkFormuGonder(event) {
        event.preventDefault(); // Sayfanın yenilenmesini/kırpışmasını engelliyoruz knk

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
                'Accept': 'application/json', // Laravel'e hata durumunda JSON fırlat diyoruz
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