<nav class="bg-white border-b border-gray-200 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ data_get($settings, 'general.company_website', '#') }}"data-bind-href="general.company_website" class="text-xl font-black tracking-wider text-gray-900 dark:text-white">PORTFOLIO
                    <span data-bind="general.company_name">{{ data_get($settings, 'general.company_name', $company->name) }}</span>
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_services_url', '#hizmetler') }}" data-bind-href="navbar.nav_services_url">
                    <span data-bind="navbar.nav_services">{{ data_get($settings, 'navbar.nav_services', 'Hizmetlerimiz') }}</span>
                </a>
                <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_about_url', '#hakkimizda') }}" data-bind-href="navbar.nav_about_url">
                    <span data-bind="navbar.nav_about">{{ data_get($settings, 'navbar.nav_about', 'Hakkımızda') }}</span>
                </a>
                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white text-sm font-medium">Yetenekler</a>
                <a class="nav-link" href="{{ data_get($settings, 'navbar.nav_contact_url', '#iletisim') }}" data-bind-href="navbar.nav_contact_url">
                    <span data-bind="navbar.nav_contact">{{ data_get($settings, 'navbar.nav_contact', 'İletişim') }}</span>
                </a>
                
                <span class="h-6 w-px bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                
                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">CV İndir</a>
            </div>
        </div>
    </div>
</nav>