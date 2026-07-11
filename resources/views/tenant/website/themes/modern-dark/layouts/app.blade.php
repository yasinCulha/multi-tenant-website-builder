<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ data_get($settings ?? [], 'meta.title', $company->name ?? data_get($settings ?? [], 'general.company_name', 'Modern Dark')) }}</title>

    @vite(['resources/css/themes/modern-dark/app.css'])
</head>
<body class="md-theme">
    @include('tenant.website.themes.modern-dark.partials.navbar')

    <main class="md-page">
        @yield('content')
    </main>
</body>
</html>
