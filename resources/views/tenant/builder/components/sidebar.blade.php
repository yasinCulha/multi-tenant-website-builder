<aside class="builder-sidebar">

   {{-- Search --}}
    <div class="sidebar-search">

        <input
            type="text"
            placeholder="Sayfa Ara..."
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

            <div
    class="page-item {{ $builder['currentPage']?->id === $page->id ? 'active' : '' }}"
    data-page-id="{{ $page->id }}"
>

    <div class="page-info">

        <span class="page-item-title">
            {{ $page->title }}
        </span>

        <span class="page-item-meta">
            /{{ $page->slug }}
        </span>

    </div>

    <button
        class="page-actions-btn"
        type="button"
    >
        ⋮
    </button>

</div>

        @endforeach

    </div>
    <div class="sidebar-footer">

    <button
        class="new-page-btn"
        type="button"
    >
        + Yeni Sayfa
    </button>

</div>
</aside>
