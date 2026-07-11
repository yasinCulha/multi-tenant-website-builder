<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ data_get($settings ?? [], 'meta.title', $company->name ?? data_get($settings ?? [], 'general.company_name', 'Corporate Blue')) }}</title>

    @vite(['resources/css/themes/corporate-blue/app.css'])
</head>
<body class="cb-theme">
    @include('tenant.website.themes.corporate-blue.partials.navbar')

    <main class="cb-page">
        @yield('content')
    </main>
</body>
</html>
