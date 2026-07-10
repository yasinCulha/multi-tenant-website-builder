<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-bind="meta.title">{{ data_get($settings, 'meta.title', $company->name . ' | Resmi Web Sitesi') }}</title>
    
    <!-- CSRF Token (Güvenli AJAX İstekleri İçin Meta Etiketi) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome İkonları -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (Plus Jakarta Sans - Kurumsal ve Modern) -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS (Modern Hata/Başarı Mesaj Kutuları İçin) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <@vite(['resources/views/tenant/website/themes/corporate-blue/assets/css/app.css',])
</head>
<body>

    @include(
    'tenant.website.themes.modules.navbar.' .
    data_get($settings, 'modules.navbar', 'navbar-menu-sağ')
)

    @include('tenant.website.themes.corporate-blue.components.hero.index')

    @include('tenant.website.themes.corporate-blue.components.services.index')

    @include('tenant.website.themes.corporate-blue.components.about.index')

    @include('tenant.website.themes.corporate-blue.components.contact.index')

    @include('tenant.website.themes.corporate-blue.components.footer.index')
    

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JavaScript CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('themes/corporate-blue/components/contact/contact.js') }}"></script>
</body>
</html>