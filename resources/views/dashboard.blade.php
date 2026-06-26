<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Yönetim Paneli - Temalar</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        
        /* Aktif Temanın Kartına Özel Çerçeve */
        .active-theme-card {
            border: 2px solid #6366f1 !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15) !important;
        }

        /* Görseldeki gibi Hover Overlay Efekti */
        .image-wrapper {
            position: relative;
            height: 180px;
            overflow: hidden;
            background: #cbd5e1;
        }
        .theme-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            padding: 15px;
        }
        .image-wrapper:hover .theme-overlay {
            opacity: 1;
        }

        /* Kartların İçindeki Yapay Renk Geçişleri */
        .demo-bg { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 16px; text-align: center; padding: 10px; }
        .bg-blue-gradient { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .bg-dark-gradient { background: linear-gradient(135deg, #1e293b, #0f172a); }
        .bg-generic-gradient { background: linear-gradient(135deg, #6366f1, #4338ca); }
    </style>
</head>
<body class="py-5">

<div class="container">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h1 class="fw-bold text-dark m-0">Temalar</h1>
            <p class="text-muted m-0 mt-1">Firmanızın web sitesi için bir tasarım seçin. Mevcut Şirket: <span class="badge bg-secondary">{{ $company->name }}</span></p>
        </div>
        <div class="d-flex gap-2">
            <a href="/site/{{ $company->slug }}" target="_blank" class="btn btn-outline-secondary fw-semibold">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Sitemi Gör
            </a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger fw-semibold">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Çıkış
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="fa-solid fa-circle-check"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="row mb-4 justify-content-end">
        <div class="col-md-5 d-flex gap-2">
            <input type="text" class="form-control" placeholder="Tema ara...">
            <button class="btn btn-dark fw-semibold px-4">Arama</button>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach($themes as $theme)
            <div class="col">
                <div class="card h-100 shadow-sm border-light rounded-3 overflow-hidden {{ $company->theme_id == $theme->id ? 'active-theme-card' : '' }}">
                    
                    <div class="image-wrapper">
                        @if($theme->folder_path == 'themes.corporate_blue')
                            <div class="demo-bg bg-blue-gradient">Kurumsal Mavi</div>
                        @elseif($theme->folder_path == 'themes.modern_dark')
                            <div class="demo-bg bg-dark-gradient">Karanlık Modern</div>
                        @else
                            <div class="demo-bg bg-generic-gradient">{{ $theme->name }}</div>
                        @endif

                        <div class="theme-overlay">
                            <a href="/site/{{ $company->slug }}" target="_blank" class="btn btn-light btn-sm w-75 fw-semibold text-dark py-2">
                                <i class="fa-solid fa-eye me-1"></i> Ön İzleme
                            </a>
                            
                            @if($company->theme_id != $theme->id)
                                <form action="/tenant/theme/update" method="POST" class="w-75">
                                    @csrf
                                    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm w-100 fw-semibold py-2" style="background-color: #6366f1; border-color: #6366f1;">
                                        <i class="fa-solid fa-wand-magic-sparkles me-1"></i> Seç / Düzenle
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="card-body d-flex justify-content-between align-items-center bg-white py-3">
                        <h6 class="card-title fw-bold m-0 text-truncate" style="max-width: 70%;">{{ $theme->name }}</h6>
                        
                        @if($company->theme_id == $theme->id)
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>