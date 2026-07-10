<nav class="navbar navbar-expand-lg kurumsal-navbar sticky-top bg-light py-3 border-bottom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 text-dark fw-black" href="{{ data_get($settings, 'general.company_website', '#') }}" data-bind-href="general.company_website">
            <i class="fa-solid fa-briefcase text-secondary"></i>
            <span class="fs-5" data-bind="general.company_name">{{ data_get($settings, 'general.company_name', $company->name) }}</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navStyleCenter">
            <i class="fa-solid fa-bars fs-4 text-dark"></i>
        </button>
        
        <div class="collapse navbar-collapse" id="navStyleCenter">
            <ul class="navbar-nav mx-auto gap-1 bg-white p-1 rounded-pill shadow-sm border px-2 d-none d-lg-flex">
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-pill fw-medium text-primary bg-primary bg-opacity-10" href="{{ data_get($settings, 'navbar.nav_home_url', '#') }}" data-bind-href="navbar.nav_home_url">
                        <span data-bind="navbar.nav_home">{{ data_get($settings, 'navbar.nav_home', 'Ana Sayfa') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-pill fw-medium text-secondary target-pill-hover" href="{{ data_get($settings, 'navbar.nav_services_url', '#hizmetler') }}" data-bind-href="navbar.nav_services_url">
                        <span data-bind="navbar.nav_services">{{ data_get($settings, 'navbar.nav_services', 'Hizmetlerimiz') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-pill fw-medium text-secondary target-pill-hover" href="{{ data_get($settings, 'navbar.nav_about_url', '#hakkimizda') }}" data-bind-href="navbar.nav_about_url">
                        <span data-bind="navbar.nav_about">{{ data_get($settings, 'navbar.nav_about', 'Hakkımızda') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-pill fw-medium text-secondary target-pill-hover" href="{{ data_get($settings, 'navbar.nav_contact_url', '#iletisim') }}" data-bind-href="navbar.nav_contact_url">
                        <span data-bind="navbar.nav_contact">{{ data_get($settings, 'navbar.nav_contact', 'İletişim') }}</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav d-flex d-lg-none gap-2 pt-3">
                <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ data_get($settings, 'navbar.nav_home_url', '#') }}">{{ data_get($settings, 'navbar.nav_home', 'Ana Sayfa') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ data_get($settings, 'navbar.nav_services_url', '#hizmetler') }}">{{ data_get($settings, 'navbar.nav_services', 'Hizmetlerimiz') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ data_get($settings, 'navbar.nav_about_url', '#hakkimizda') }}">{{ data_get($settings, 'navbar.nav_about', 'Hakkımızda') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ data_get($settings, 'navbar.nav_contact_url', '#iletisim') }}">{{ data_get($settings, 'navbar.nav_contact', 'İletişim') }}</a></li>
            </ul>

            <div class="d-none d-lg-block" style="width: 160px;"></div>
        </div>
    </div>
</nav>

<style>
.target-pill-hover:hover {
    background-color: rgba(0, 0, 0, 0.04);
    color: #111 !important;
}
</style>