<nav class="navbar navbar-expand-lg kurumsal-navbar sticky-top bg-dark navbar-dark py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 text-white" href="{{ data_get($settings, 'general.company_website', '#') }}" data-bind-href="general.company_website">
            <span class="p-2 bg-warning rounded-3 text-dark d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <i class="fa-solid fa-briefcase fs-6"></i>
            </span>
            <span class="fw-bold fs-5 tracking-tight" data-bind="general.company_name">{{ data_get($settings, 'general.company_name', $company->name) }}</span>
        </a>

        <button class="navbar-toggler border-0 bg-secondary bg-opacity-25" type="button" data-bs-toggle="collapse" data-bs-target="#navStyleRight">
            <i class="fa-solid fa-bars fs-4 text-white"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navStyleRight">
            <ul class="navbar-nav gap-2 pt-3 pt-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-white bg-secondary bg-opacity-25 d-flex align-items-center gap-2" href="{{ data_get($settings, 'navbar.nav_home_url', '#') }}" data-bind-href="navbar.nav_home_url">
                        <i class="fa-solid fa-house text-warning small"></i>
                        <span data-bind="navbar.nav_home">{{ data_get($settings, 'navbar.nav_home', 'Ana Sayfa') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-white-50 target-block-hover d-flex align-items-center gap-2" href="{{ data_get($settings, 'navbar.nav_services_url', '#hizmetler') }}" data-bind-href="navbar.nav_services_url">
                        <i class="fa-solid fa-layer-group small"></i>
                        <span data-bind="navbar.nav_services">{{ data_get($settings, 'navbar.nav_services', 'Hizmetlerimiz') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-white-50 target-block-hover d-flex align-items-center gap-2" href="{{ data_get($settings, 'navbar.nav_about_url', '#hakkimizda') }}" data-bind-href="navbar.nav_about_url">
                        <i class="fa-solid fa-circle-info small"></i>
                        <span data-bind="navbar.nav_about">{{ data_get($settings, 'navbar.nav_about', 'Hakkımızda') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-white-50 target-block-hover d-flex align-items-center gap-2" href="{{ data_get($settings, 'navbar.nav_contact_url', '#iletisim') }}" data-bind-href="navbar.nav_contact_url">
                        <i class="fa-solid fa-envelope small"></i>
                        <span data-bind="navbar.nav_contact">{{ data_get($settings, 'navbar.nav_contact', 'İletişim') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
.target-block-hover:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff !important;
}
</style>