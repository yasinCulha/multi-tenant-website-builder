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