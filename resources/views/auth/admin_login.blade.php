<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Süper Admin Girişi | Yönetim Merkezi</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #030712;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .admin-login-kart {
            background-color: #0b0f19;
            border: 1px solid #1f2937;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.7);
        }
        .custom-input {
            background-color: #111827 !important;
            border-color: #374151 !important;
            color: #ffffff !important;
        }
        .custom-input:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.25) !important;
        }
        .text-indigo { 
            color: #6366f1;
        }
        .custom-input::placeholder {
            color: rgba(211, 211, 211, 0.5) !important;
        }
        
    </style>
</head>
<body>

<div class="admin-login-kart">
    <div class="text-center mb-4">
        <!-- Logo Alanı -->
        <h2 class="text-white fw-bold m-0"><i class="fa-solid fa-user-shield text-indigo me-2"></i>SuperAdmin</h2>
        <p class="text-gray small mt-2" style="color:white">Yönetim Merkezi Yetkili Girişi</p>
    </div>

    <!-- Hata Bildirim Alanı -->
    @if ($errors->any())
        <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger small py-2 mb-3">
            @foreach ($errors->all() as $error)
                <div class="d-flex align-items-center"><i class="fa-solid fa-circle-exclamation me-2"></i> {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label text-light small fw-medium">Yetkili E-posta</label>
            <input type="email" name="email" class="form-control custom-input" value="{{ old('email') }}" required autofocus placeholder="admin@system.com">
        </div>

        <div class="mb-3">
            <label class="form-label text-light small fw-medium">Güvenlik Şifresi</label>
            <input type="password" name="password" class="form-control custom-input" required placeholder="******">
        </div>

        <div class="mb-4 form-check">
            <input type="checkbox" name="remember" class="form-check-input bg-dark border-secondary" id="remember">
            <label class="form-check-label small" for="remember" style="color:white">Beni Hatırla</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-semibold py-2" style="background-color: #6366f1; border: none;">
            <i class="fa-solid fa-right-to-bracket me-2"></i> Yönetim Merkezini Aç
        </button>
    </form>
</div>

</body>
</html> 