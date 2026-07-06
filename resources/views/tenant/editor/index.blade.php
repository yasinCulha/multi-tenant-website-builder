<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Tema Düzenleyici</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>

<body>

    @include('tenant.editor.navbar')

    <div class="editor-container">

        @include('tenant.editor.sidebar')

        <div class="panel-container">

            @foreach(($editor['sections'] ?? []) as $section)

                @include(
                    'tenant.editor.components.section',
                    [
                        'section' => $section
                    ]
                )

            @endforeach

        </div>
        
        @include('tenant.editor.preview')

    </div>
@vite('resources/js/app.js')
</body>
    
</html> 

