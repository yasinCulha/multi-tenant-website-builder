<header class="md-navbar">
    <div class="md-container md-navbar__inner">
        <a class="md-navbar__brand" href="{{ data_get($settings ?? [], 'general.company_website', '/') }}">
            {{ $company->name ?? data_get($settings ?? [], 'general.company_name', 'Firma Adi') }}
        </a>

        <nav class="md-navbar__menu" aria-label="Ana menu">
            <a href="{{ data_get($settings ?? [], 'navbar.nav_home_url', '#ana-sayfa') }}">{{ data_get($settings ?? [], 'navbar.nav_home', 'Anasayfa') }}</a>
            <a href="{{ data_get($settings ?? [], 'navbar.nav_about_url', '#hakkimizda') }}">{{ data_get($settings ?? [], 'navbar.nav_about', 'Hakkimizda') }}</a>
            <a href="{{ data_get($settings ?? [], 'navbar.nav_services_url', '#hizmetler') }}">{{ data_get($settings ?? [], 'navbar.nav_services', 'Hizmetler') }}</a>
            <a href="{{ data_get($settings ?? [], 'navbar.nav_contact_url', '#iletisim') }}">{{ data_get($settings ?? [], 'navbar.nav_contact', 'Iletisim') }}</a>
        </nav>

        <a class="md-button md-button--sm" href="{{ data_get($settings ?? [], 'navbar.cta_button_url', '#iletisim') }}">
            {{ data_get($settings ?? [], 'navbar.cta_button_text', 'Teklif Al') }}
        </a>
    </div>
</header>
