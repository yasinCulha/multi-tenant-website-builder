<nav class="navbar navbar-expand-lg kurumsal-navbar sticky-top bg-white border-bottom py-3 shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark text-uppercase tracking-wider" href="{{ data_get($settings, 'general.company_website', '#') }}" data-bind-href="general.company_website">
            <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded" style="width: 35px; height: 35px;">
                <i class="fa-solid fa-briefcase fs-5"></i>
            </div>
            <span data-bind="general.company_name">{{ data_get($settings, 'general.company_name', $company->name) }}</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navStyleLeft">
            <i class="fa-solid fa-bars-staggered fs-4 text-dark"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-start" id="navStyleLeft">
            <ul class="navbar-nav ms-lg-5 gap-3 target-minimal-links">
                <li class="nav-item">
                    <a class="nav-link px-2 fw-semibold text-dark position-relative" href="{{ data_get($settings, 'navbar.nav_home_url', '#') }}" data-bind-href="navbar.nav_home_url">
                        <span data-bind="navbar.nav_home">{{ data_get($settings, 'navbar.nav_home', 'Ana Sayfa') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 fw-semibold text-muted position-relative" href="{{ data_get($settings, 'navbar.nav_services_url', '#hizmetler') }}" data-bind-href="navbar.nav_services_url">
                        <span data-bind="navbar.nav_services">{{ data_get($settings, 'navbar.nav_services', 'Hizmetlerimiz') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 fw-semibold text-muted position-relative" href="{{ data_get($settings, 'navbar.nav_about_url', '#hakkimizda') }}" data-bind-href="navbar.nav_about_url">
                        <span data-bind="navbar.nav_about">{{ data_get($settings, 'navbar.nav_about', 'Hakkımızda') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 fw-semibold text-muted position-relative" href="{{ data_get($settings, 'navbar.nav_contact_url', '#iletisim') }}" data-bind-href="navbar.nav_contact_url">
                        <span data-bind="navbar.nav_contact">{{ data_get($settings, 'navbar.nav_contact', 'İletişim') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
/* Bu css bloğunu projenin ortak css dosyasına koyabilirsin */
.target-minimal-links .nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 8px;
    background-color: var(--bs-primary, #0d6efd);
    transition: width 0.3s ease;
}
.target-minimal-links .nav-link:hover::after {
    width: calc(100% - 16px);
}
.target-minimal-links .nav-link:hover {
    color: var(--bs-primary, #0d6efd) !important;
}
</style>