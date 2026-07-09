<nav class="navbar navbar-expand-lg kurumsal-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ data_get($settings, 'general.company_website', '#') }}" data-bind-href="general.company_website">
                <i class="fa-solid fa-briefcase"></i>
                <span data-bind="general.company_name">{{ data_get($settings, 'general.company_name', $company->name) }}</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars fs-4 text-dark"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_home_url', '#') }}" data-bind-href="navbar.nav_home_url">
                            <span data-bind="navbar.nav_home">{{ data_get($settings, 'navbar.nav_home', 'Ana Sayfa') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_services_url', '#hizmetler') }}" data-bind-href="navbar.nav_services_url">
                            <span data-bind="navbar.nav_services">{{ data_get($settings, 'navbar.nav_services', 'Hizmetlerimiz') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_about_url', '#hakkimizda') }}" data-bind-href="navbar.nav_about_url">
                            <span data-bind="navbar.nav_about">{{ data_get($settings, 'navbar.nav_about', 'Hakkımızda') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_contact_url', '#iletisim') }}" data-bind-href="navbar.nav_contact_url">
                            <span data-bind="navbar.nav_contact">{{ data_get($settings, 'navbar.nav_contact', 'İletişim') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>