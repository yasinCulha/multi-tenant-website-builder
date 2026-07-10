<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-bind="meta.title">{{ data_get($settings, 'meta.title', $company->name . ' | Resmi Web Sitesi') }}</title>
    
    <!-- CSRF Token Metası -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @vite([
        'resources/views/tenant/website/themes/modern-dark/assets/css/app.css',
        'resources/views/tenant/website/themes/modern-dark/assets/js/app.js',
    ])
</head>
<body>
    

    @include(
    'tenant.website.themes.modules.navbar.' .
    data_get($settings, 'modules.navbar', 'navbar-menu-sol')
)

    @include('tenant.website.themes.modern-dark.components.hero.index')

    @include('tenant.website.themes.modern-dark.components.services.index')

    @include('tenant.website.themes.modern-dark.components.about.index')

    @include('tenant.website.themes.modern-dark.components.contact.index')

    @include('tenant.website.themes.modern-dark.components.footer.index')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>