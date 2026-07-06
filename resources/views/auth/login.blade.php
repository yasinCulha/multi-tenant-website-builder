<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Giriş Paneli | TenantPanel</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome İkonları -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-deep-black: #090a0f;    /* Derin Arka Plan Siyahı */
            --bg-card-black: #12141c;    /* Kart Siyahı */
            --brand-orange: #ff6b00;     /* Canlı Turuncu */
            --brand-orange-hover: #e05e00;
            --text-gray: #94a3b8;
            --border-color: #222533;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-deep-black);
            color: #ffffff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            /* Arka plana hafif turuncu bir parlama efekti */
            background: radial-gradient(circle at center, rgba(255, 107, 0, 0.05), transparent 60%), var(--bg-deep-black);
        }

        .login-container {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .company-login-card {
            background-color: var(--bg-card-black);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
            transition: border-color 0.3s;
        }

        /* Input Alanları Özelleştirmesi */
        .custom-input {
            background-color: #1a1d29 !important;
            border: 1px solid var(--border-color) !important;
            color: #ffffff !important;
            padding: 12px 16px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .custom-input:focus {
            border-color: var(--brand-orange) !important;
            box-shadow: 0 0 12px rgba(255, 107, 0, 0.2) !important;
            color: #ffffff !important;
        }

        .custom-input::placeholder {
            color: #4b5563;
        }

        /* Turuncu Premium Buton */
        .btn-orange-submit {
            background-color: var(--brand-orange);
            color: #ffffff;
            font-weight: 700;
            padding: 14px;
            border-radius: 10px;
            border: none;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-orange-submit:hover {
            background-color: var(--brand-orange-hover);
            color: #ffffff;
            box-shadow: 0 0 20px rgba(255, 107, 0, 0.3);
        }

        .brand-logo-area h2 span {
            color: var(--brand-orange);
        }

        /* Backend Validation Hata Kutusu */
        .backend-error-box {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
            color: #ef4444;
            font-size: 14px;
            padding: 12px 16px;
        }

        .form-check-input:checked {
            background-color: var(--brand-orange) !important;
            border-color: var(--brand-orange) !important;
        }
    </style>
</head>
<body>

<div class="login-container">
    
    <!-- Geri Dönüş Linki (Tanıtım Sayfasına) -->
    <div class="mb-4">
        <a href="{{ route('welcome') }}" class="text-decoration-none small fw-semibold" style="color: var(--text-gray);">
            <i class="fa-solid fa-arrow-left me-1"></i> Tanıtım Sayfasına Dön
        </a>
    </div>

    <div class="company-login-card">
        <!-- Kart Başlığı -->
        <div class="text-center brand-logo-area mb-4">
            <h2 class="text-white fw-extrabold m-0">
                <i class="fa-solid fa-building me-2" style="color: var(--brand-orange);"></i>Tenant<span>Panel</span>
            </h2>
            <p class="small mt-2" style="color: var(--text-gray);">Firma & Acente Yönetim Girişi</p>
        </div>

        <!-- ------------------------------------------------------------------ -->
        <!-- BACKEND VALIDATION VE METOT MESAJLARININ ÇALIŞTIĞI ALAN -->
        <!-- ------------------------------------------------------------------ -->
        @if ($errors->any())
            <div class="backend-error-box mb-4 shadow-sm">
                @foreach ($errors->all() as $error)
                    <div class="d-flex align-items-center my-1">
                        <i class="fa-solid fa-circle-exclamation me-2 flex-shrink-0"></i>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif
        <!-- ------------------------------------------------------------------ -->

        <!-- FORM BAŞLANGICI (Doğru İsme Post Ediliyor) -->
        <form action="{{ route('company.login.submit') }}" method="POST">
            @csrf

            <!-- E-posta Adresi -->
            <div class="mb-3">
                <label class="form-label small fw-semibold" style="color: var(--text-gray);">Firma Yetkili E-posta</label>
                <div class="input-group">
                    <input type="email" name="email" class="form-control custom-input" 
                           value="{{ old('email') }}" required autofocus placeholder="ornek@firma.com">
                </div>
            </div>

            <!-- Şifre -->
            <div class="mb-3">
                <label class="form-label small fw-semibold" style="color: var(--text-gray);">Giriş Şifresi</label>
                <input type="password" name="password" class="form-control custom-input" 
                       required placeholder="******">
            </div>

            <!-- Beni Hatırla -->
            <div class="mb-4 form-check d-flex align-items-center">
                <input type="checkbox" name="remember" class="form-check-input bg-dark border-secondary me-2" id="remember">
                <label class="form-check-label small user-select-none" for="remember" style="color: var(--text-gray); margin-top: 3px;">
                    Beni Hatırla
                </label>
            </div>

            <!-- Gönder Butonu -->
            <button type="submit" class="btn-orange-submit fw-bold">
                <i class="fa-solid fa-right-to-bracket me-2"></i> Firmaya Giriş Yap
            </button>
        </form>

    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>