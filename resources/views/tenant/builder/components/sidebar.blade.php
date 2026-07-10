<aside class="builder-sidebar">

    <div class="sidebar-search">

        <input
            type="text"
            placeholder="Ara..."
        >

    </div>

    <div class="sidebar-menu">

        <button class="sidebar-item active">
            📄 Sayfalar
        </button>

        <button class="sidebar-item">
            🧩 Modüller
        </button>

        <button class="sidebar-item">
            🖼️ Medya
        </button>

        <button class="sidebar-item">
            ⚙️ Site Ayarları
        </button>

    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-pages">

        @foreach($builder['pages'] as $page)

            <div class="page-item">

                {{ $page->title }}

            </div>

        @endforeach

    </div>

</aside>