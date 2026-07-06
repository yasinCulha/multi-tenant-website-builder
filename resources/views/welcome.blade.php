<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TenantPanel | Geleceğin Şirket Yönetim Platformu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-deep-black: #090a0f;    /* Derin Uzay Siyahı */
            --bg-card-black: #12141c;    /* Kartlar İçin Hafif Açık Siyah */
            --brand-orange: #ff6b00;     /* Canlı Turuncu Vurgu */
            --brand-orange-hover: #e05e00;
            --text-gray: #94a3b8;        /* Soft Gri Okuma Metni */
            --border-color: #222533;     /* İnce Geometrik Çizgiler */
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-deep-black);
            color: #ffffff;
            line-height: 1.6;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* NAVBAR (ÜST MENÜ) */
        .neon-navbar {
            background-color: rgba(9, 10, 15, 0.85) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 20px 0;
        }

        .navbar-brand-orange {
            font-weight: 800;
            color: #ffffff !important;
            letter-spacing: -0.5px;
            font-size: 24px;
        }

        .navbar-brand-orange span {
            color: var(--brand-orange);
        }

        /* HERO ALANI (ANA KARŞILAMA) */
        .hero-premium {
            padding: 160px 0 100px 0;
            background: radial-gradient(circle at top left, rgba(255, 107, 0, 0.1), transparent 45%);
            position: relative;
        }

        .orange-gradient-text {
            background: linear-gradient(135deg, #ffffff 30%, var(--brand-orange) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .hero-subtitle {
            color: var(--text-gray);
            font-size: 19px;
            max-width: 600px;
        }

        /* HİZMET/AVANTAJ KARTLARI */
        .orange-card {
            background-color: var(--bg-card-black);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 35px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .orange-card:hover {
            transform: translateY(-8px);
            border-color: var(--brand-orange);
            box-shadow: 0 12px 30px rgba(255, 107, 0, 0.08);
        }

        .orange-icon-box {
            width: 55px;
            height: 55px;
            background-color: rgba(255, 107, 0, 0.08);
            color: var(--brand-orange);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 25px;
            transition: all 0.3s;
        }

        .orange-card:hover .orange-icon-box {
            background-color: var(--brand-orange);
            color: #ffffff;
            box-shadow: 0 0 15px rgba(255, 107, 0, 0.3);
        }

        /* PREMIUM BUTONLAR */
        .btn-orange-filled {
            background-color: var(--brand-orange);
            color: #ffffff;
            font-weight: 700;
            padding: 14px 32px;
            border-radius: 10px;
            border: none;
            transition: all 0.2s;
        }

        .btn-orange-filled:hover {
            background-color: var(--brand-orange-hover);
            color: #ffffff;
            box-shadow: 0 0 20px rgba(255, 107, 0, 0.3);
        }

        .btn-orange-outline {
            background-color: transparent;
            color: #ffffff;
            border: 2px solid var(--border-color);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .btn-orange-outline:hover {
            border-color: var(--brand-orange);
            color: var(--brand-orange);
        }

        /* ALT BİLGİ (FOOTER) */
        .dark-footer {
            background-color: #050508;
            border-top: 1px solid var(--border-color);
            padding: 40px 0;
            margin-top: 120px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg neon-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand navbar-brand-text navbar-brand-orange" href="#">
                <i class="fa-solid fa-cubes text-orange me-2" style="color: var(--brand-orange);"></i>Tenant<span>Panel</span>
            </a>
            
            <div class="ms-auto">
                <a href="{{ route('company.login') }}" class="btn btn-orange-filled btn-sm px-4 py-2">
                    <i class="fa-solid fa-right-to-bracket me-2"></i>Firma Girişi
                </a>
            </div>
        </div>
    </nav>

    <header class="hero-premium">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <span class="badge bg-dark border border-secondary text-light px-3 py-2 rounded-pill mb-4 fw-medium" style="border-color: rgba(255,107,0,0.3) !important;">
                        🔥 Çoklu Şirket (Multi-Tenant) Otomasyon Altyapısı
                    </span>
                    <h1 class="display-4 fw-extrabold text-white mb-4 hero-baslik">
                        Tüm Alt Şirketlerinizi <br>
                        <span class="orange-gradient-text">Tek Merkezden</span> Özgürce Yönetin
                    </h1>
                    <p class="hero-subtitle mb-5">
                        Acenteleriniz, alt firmalarınız ve bayileriniz için özel olarak geliştirilmiş bulut tabanlı yönetim ekosistemi. Güçlü mimari, benzersiz hız ve tam kontrol.
                    </p>
                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                        <a href="{{ route('company.login') }}" class="btn btn-orange-filled px-4 py-3 text-decoration-none shadow">
                            Panelinize Giriş Yapın <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                        <a href="#ozellikler" class="btn btn-orange-outline px-4 py-3 text-decoration-none">
                            Platformu Keşfedin
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 text-center d-none d-lg-block">
                    <i class="fa-solid fa-network-wired" style="font-size: 260px; color: rgba(255, 107, 0, 0.04); filter: drop-shadow(0 0 30px rgba(255,107,0,0.1));"></i>
                </div>
            </div>
        </div>
    </header>

    <section id="ozellikler" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-white">Neden Bizim Altyapımız?</h2>
                <p class="text-color-gray">Firmalarınızın gücüne güç katacak teknolojik yetenekler</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="orange-card h-100">
                        <div class="orange-icon-box">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <h5 class="text-white fw-bold mb-3">İzole Veri Yapısı</h5>
                        <p class="small text-gray m-0">Her firmaya ait otomasyon verileri, veritabanı seviyesinde birbirine asla karışmayacak şekilde güvenle şifrelenir ve izole edilir.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="orange-card h-100">
                        <div class="orange-icon-box">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h5 class="text-white fw-bold mb-3">Ultra Dinamik Otomasyon</h5>
                        <p class="small text-gray m-0">Telefon kanalları, sosyal medya bağları ve kurumsal temalar tek tıkla admin tarafından dağıtılır ve anında senkronize olur.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="orange-card h-100">
                        <div class="orange-icon-box">
                            <i class="fa-solid fa-user-lock"></i>
                        </div>
                        <h5 class="text-white fw-bold mb-3">Güvenli Giriş Kapısı</h5>
                        <p class="small text-gray m-0">Süper admin ve alt firmaların oturum süreçleri tamamen birbirinden ayrılmıştır, sızma ve yetki karmaşası ihtimalleri sıfırdır.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="dark-footer">
        <div class="container text-center">
            <p class=" m-0 fw-semibold">&copy; 2026 TenantPanel. Tüm Hakları Saklıdır.</p>
            <p class="small text-secondary mt-2 mb-0">Güvenli Çoklu Şirket Dağıtım Ekosistemi Merkezi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>