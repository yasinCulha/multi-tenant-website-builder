<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Yönetim Paneli</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Tüm sayfayı kapsayan modern karanlık arka plan ayarları */
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #0b0f19; /* Çok koyu lacivert/siyah */
            color: #f1f5f9; 
            overflow-x: hidden;
        }
        
        /* SOL MENÜ (SIDEBAR) STİLLERİ */
        .sol-sidebar-menusu {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111827; /* Grafit koyu gri */
            border-right: 1px solid #1f2937;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-logo {
            font-size: 20px;
            font-weight: 700;
            color: #6366f1; /* Canlı mor renk */
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .menuler-listesi {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-elemani {
            margin-bottom: 8px;
        }

        .menu-linki {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #9ca3af;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.2s ease-in-out;
        }

        /* Menü elemanının üzerine gelindiğinde veya aktif olduğunda */
        .menu-linki:hover, .menu-linki.aktif-menu {
            background-color: #1f2937;
            color: #ffffff;
        }

        .menu-linki.aktif-menu i {
            color: #6366f1;
        }

        /* SAĞ İÇERİK ALANI (MAIN CONTENT) */
        .sag-icerik-alani {
            margin-left: 260px; /* Menünün genişliği kadar boşluk bırakıyoruz */
            padding: 40px;
            min-height: 100vh;
        }

        /* TEMA KARTLARI STİLLERİ */
        .karanlik-tema-karti {
            background-color: #111827 !important;
            border: 1px solid #1f2937 !important;
            border-radius: 12px !important;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .karanlik-tema-karti:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        /* Eğer firma bu temayı seçtiyse etrafında parlayan mor bir çerçeve olsun */
        .secili-aktif-tema-karti {
            border: 2px solid #6366f1 !important;
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.2) !important;
        }

        /* Kartların Üstündeki Resim Alanı */
        .kart-resim-alani {
            position: relative;
            height: 180px;
            background-color: #1f2937;
            overflow: hidden;
        }

        /* Resmin üzerine gelince açılan buton katmanı */
        .kart-hover-katmani {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.85);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
        }

        .kart-resim-alani:hover .kart-hover-katmani {
            opacity: 1;
        }
        ::placeholder {
            color: #9ca3af !important;
            opacity: 1 !important;
        }

        /* Yapay önizleme arka plan renk geçişleri */
        .yapay-grafik-arkasi { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px; color: #ffffff; }
        .mavi-gradyan { background: linear-gradient(135deg, #1e40af, #3b82f6); }
        .siyah-gradyan { background: linear-gradient(135deg, #111827, #374151); }
        .mor-gradyan { background: linear-gradient(135deg, #4c1d95, #8b5cf6); }
    </style>
</head>
<body>

    <div class="sol-sidebar-menusu">
        <div>
            <div class="sidebar-logo">
                <i class="fa-solid fa-cubes-stacked"></i>
                <span>Firma Yönetim Panel</span>
            </div>

            <ul class="menuler-listesi">
                <li class="menu-elemani">
                    <a href="#" class="menu-linki aktif-menu">
                        <i class="fa-solid fa-palette"></i>
                        <span>Tema Seçimi</span>
                    </a>
                </li>
                <li class="menu-elemani">
                    <a href="#" class="menu-linki">
                        <i class="fa-solid fa-file-lines"></i>
                        <span>Sayfalarım</span>
                    </a>
                </li>
                <li class="menu-elemani">
                    <a href="#" class="menu-linki">
                        <i class="fa-solid fa-gears"></i>
                        <span>Ayarlar</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-alt-alan border-top border-secondary pt-3">
            <div class="small text-gray mb-2">Giriş Yapan Yetkili:</div>
            <div class="fw-bold text-light mb-3 text-truncate">{{ auth()->user()->name }}</div>
            
            <form action="{{ route('logout') }}" method="POST" class="w-100">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-semibold">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Güvenli Çıkış
                </button>
            </form>
        </div>
    </div>

    <div class="sag-icerik-alani">
        
        <div class="row align-items-center mb-5">
            <div class="col-md-8">
                <h1 class="fw-bold m-0 text-white">Web Sitesi Temaları</h1>
                <p class="text-gray m-0 mt-1">Mevcut Şirketiniz: <span class="text-white-50 fw-semibold">{{ $company->name }}</span></p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="/site/{{ $company->slug }}" target="_blank" class="btn btn-dark border-secondary text-light fw-medium px-4">
                    <i class="fa-solid fa-external-link me-2"></i> Sitemi Canlı Gör
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-success-subtle text-success border-0 d-flex align-items-center gap-2 mb-4" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="row mb-4" id="temaListesiGrid">

            @php
                $aktif_tema = $themes->first(fn($t) => $company->theme_id == $t->id);
            @endphp

            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="fw-bold text-white mb-3">Seçili Temanız</h2>
                    @if($aktif_tema)
                        <div class="card p-3 shadow border-success" style="background:#1e293b; max-width:500px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-success mb-2">
                                        <i class="fa-solid fa-circle-check me-1"></i> Aktif Tema
                                    </span>
                                    <h4 class="text-white mb-0">{{ $aktif_tema->name }}</h4>
                                </div>
                                <a href="{{ route('company.theme.editor', ['theme' => $aktif_tema->id]) }}"target="_blank" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Düzenle
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning d-inline-block" style="min-width: 300px;">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i> Tema seçilmedi.
                        </div>
                    @endif
                </div>
            </div>

            <hr class="border-secondary mb-4">

            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h2 class="fw-bold text-white mb-0">Tema Listesi</h2>
                </div>
                <div class="col-md-6 d-flex justify-content-md-end mt-3 mt-md-0">
                    <div style="width:350px; max-width: 100%;">
                        <div class="input-group">
                            <input type="text" 
                                id="temaAramaInput" 
                                class="form-control" 
                                placeholder="Tema modeli ara..." 
                                oninput="filterThemes()">
                            <button class="btn btn-outline-light">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($themes as $tekil_tema_verisi)
                    @php
                        $bu_tema_aktif_mi = ($company->theme_id == $tekil_tema_verisi->id);
                    @endphp

                    <div class="col d-flex align-items-stretch">
                        <div class="card w-100 shadow-sm border-light rounded-3 overflow-hidden {{ $bu_tema_aktif_mi ? 'secili-aktif-tema-karti border-success border-2' : '' }}" style="background-color: #111827;">
                            
                            <div class="kart-resim-alani w-100 position-relative">
                                <div class="yapay-grafik-arkasi {{ $tekil_tema_verisi->slug }} text-center text-white py-5 fw-bold">
                                    {{ $tekil_tema_verisi->name }}
                                </div>

                                <div class="kart-hover-katmani">
                                    @if($bu_tema_aktif_mi)
                                        {{-- Aktif tema ise Düzenle Butonu --}}
                                        <a href="{{ route('company.theme.editor', ['theme' => $tekil_tema_verisi->id]) }}" target="_blank" class="btn btn-success btn-sm w-75 fw-semibold py-2">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Temayı Düzenle
                                        </a>
                                    @else
                                        {{-- Aktif değilse Temayı Seç Formu --}}
                                        <a href="{{ route('theme.preview', ['themeId' => $tekil_tema_verisi->id]) }}" target="_blank" class="btn btn-light btn-sm w-75 fw-semibold py-2 mb-2">
                                            <i class="fa-solid fa-eye me-1"></i> Ön İzleme
                                        </a>
                                        <form action="{{ route('company.theme.update') }}" method="POST" class="w-75"">
                                            @csrf
                                            <input type="hidden" name="theme_id" value="{{ $tekil_tema_verisi->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm w-100 fw-semibold py-2" style="background:#6366f1; border:none;">
                                                <i class="fa-solid fa-check me-1"></i> Temayı Seç
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body d-flex justify-content-between align-items-center py-3 bg-white">
                                <h6 class="card-title fw-bold m-0 text-dark text-truncate" style="max-width: 65%;">
                                    {{ $tekil_tema_verisi->name }}
                                </h6>
                                
                                @if($bu_tema_aktif_mi)
                                    <span class="badge text-success bg-success-subtle px-3 py-1 rounded-pill fw-bold">
                                        <i class="fa-solid fa-check me-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge text-secondary bg-light px-3 py-1 rounded-pill fw-medium">
                                        Tasarım
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterThemes() {
    // 1. ID üzerinden arama inputunu yakalayıp değerini küçük harfe çeviriyoruz
    const aramaInput = document.getElementById('temaAramaInput');
    if (!aramaInput) return; // Input bulunamazsa hata vermemesi için koruma
    
    const aramaMetni = aramaInput.value.toLowerCase();
    
    // 2. Bir önceki kodda döngüye soktuğumuz her bir tema kolonunu yakalıyoruz
    // Kartların düzgün gizlenmesi için üst kapsayıcı olan .col sınıfını hedefliyoruz
    const temaKartlari = document.querySelectorAll('.row-cols-lg-4 > .col');

    // 3. Döngümüzü başlatıyoruz
    for (let index = 0; index < temaKartlari.length; index++) {
        
        // Kartın altındaki beyaz alanda yer alan .card-title (h6) etiketini buluyoruz
        let temaAdiEtiketi = temaKartlari[index].querySelector('.card-title');
        
        if (temaAdiEtiketi) {
            // Başlığı küçük harfe çeviriyoruz
            let temizTemaIsmi = (temaAdiEtiketi.textContent || temaAdiEtiketi.innerText).toLowerCase();

            // 4. Arama metni temanın isminin içinde geçiyor mu?
            if (temizTemaIsmi.indexOf(aramaMetni) > -1) {
                // Eğer eşleşme varsa Bootstrap grid düzenini bozmamak için display'i sıfırlıyoruz
                temaKartlari[index].style.setProperty('display', '', 'important'); 
            } else {
                // Eşleşme yoksa kolonu tamamen gizliyoruz
                temaKartlari[index].style.setProperty('display', 'none', 'important'); 
            }
        }           
    }
}
</script>
</body>
</html>