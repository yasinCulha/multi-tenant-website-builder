<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Firma Yönetim Paneli')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite --}}
    @vite([
        'resources/views/tenant/website/admin/assets/css/app.css',
        'resources/views/tenant/website/admin/assets/js/app.js',
    ])

</head>

<body>

<div class="admin-wrapper">

    @include('tenant.website.admin.layouts.sidebar')

    <div class="admin-main">

        @include('tenant.website.admin.layouts.navbar')

        <main class="admin-content">

            @yield('content')

        </main>

    </div>

</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>

</html>