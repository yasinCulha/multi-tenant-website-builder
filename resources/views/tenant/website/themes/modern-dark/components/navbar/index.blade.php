<nav class="navbar navbar-expand-lg modern-karanlik-navbar fixed-top py-3">
        <div class="container">
            <a class="navbar-brand navbar-brand-text" href="{{ data_get($settings, 'general.company_website') }}" data-bind="general.company_name">
                <i class="fa-solid fa-terminal me-2"></i>{{ $company->name }}
            </a>
            
            <button class="navbar-toggler border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarIcerik">
                <span class="navbar-toggler-icon text-light"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarIcerik">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ data_get($settings, 'navbar.nav_home_url', '#ana-sayfa') }}"
                            data-bind-href="navbar.nav_home_url">

                            <span data-bind="navbar.nav_home">
                                {{ data_get($settings, 'navbar.nav_home', 'Ana Sayfa') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" 
                            href="{{ data_get($settings, 'navbar.nav_services_url', '#hizmetler') }}" 
                            data-bind-href="navbar.nav_services_url">
                            <span data-bind="navbar.nav_services">
                                {{ data_get($settings, 'navbar.nav_services', 'Hizmetler') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_about_url', '#hakkimizda') }}" data-bind-href="navbar.nav_about_url">
                            <span data-bind="navbar.nav_about">
                                {{ data_get($settings, 'navbar.nav_about', 'Hakkımızda') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_contact_url', '#iletisim') }}" data-bind-href="navbar.nav_contact_url">
                            <span data-bind="navbar.nav_contact">
                                {{ data_get($settings, 'navbar.nav_contact', 'İletişim') }}
                            </span>
                        </a>
                    </li>
                </ul>
                <a
                    href="{{ data_get($settings, 'navbar.cta_button_url', 'https://wa.me/' . $company->whatsapp_number) }}"
                    data-bind="navbar.cta_button_url"
                    data-bind-attr="href"
                    class="btn btn-primary btn-sm ms-lg-3 px-4 py-2 fw-semibold"
                    style="background-color: #6366f1; border: none; border-radius: 8px;">

                    <span data-bind="navbar.cta_button_text">
                        {{ data_get($settings, 'navbar.cta_button_text', 'Teklif Al') }}
                    </span>

                </a>
            </div>
        </div>
    </nav>