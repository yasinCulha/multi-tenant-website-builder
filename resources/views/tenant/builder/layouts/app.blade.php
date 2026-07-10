<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Page Builder</title>

    @vite([
    'resources/css/app.css',

    'resources/css/builder/builder.css',
    'resources/css/builder/sidebar.css',
    'resources/css/builder/preview.css',
    'resources/css/builder/settings.css',

    'resources/js/app.js',
    'resources/js/builder/builder.js',
])
</head>
<body>

    @yield('content')

</body>
</html>