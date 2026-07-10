<aside class="builder-sidebar">

    <div class="sidebar-search">

        <input
            type="text"
            placeholder="Ara..."
        >

    </div>

    <div class="sidebar-menu">

        <button class="sidebar-item active" type="button">
            <span class="sidebar-item-icon">P</span>
            <span>Sayfalar</span>
        </button>

        <button class="sidebar-item" type="button">
            <span class="sidebar-item-icon">M</span>
            <span>Moduller</span>
        </button>

        <button class="sidebar-item" type="button">
            <span class="sidebar-item-icon">A</span>
            <span>Medya</span>
        </button>

        <button class="sidebar-item" type="button">
            <span class="sidebar-item-icon">S</span>
            <span>Site Ayarlari</span>
        </button>

    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-pages">

        @foreach($builder['pages'] as $page)

            <div class="page-item">

                <span class="page-item-title">{{ $page->title }}</span>
                <span class="page-item-meta">Page</span>

            </div>

        @endforeach

    </div>

</aside>
