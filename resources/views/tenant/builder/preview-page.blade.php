<!DOCTYPE html>
<html>
<head>
    <title>Preview</title>
</head>
<body>
<div class="preview-actions">

    <button id="add-module-btn">
        + Modül Ekle
    </button>

</div>
<div class="available-modules">

    @foreach($builder['availableModules'] as $module)

        <div class="available-module">

            {{ $module->name }}

        </div>

    @endforeach

</div>
<h1 style="text-align:center;margin-top:100px;">

    🚀 Gerçek Web Sitesi Burada Çalışacak

</h1>

</body>
</html>