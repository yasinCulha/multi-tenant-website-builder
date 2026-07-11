<aside class="builder-sidebar">

    {{-- Search --}}
    <div class="sidebar-search">

        <input
            type="text"
            placeholder="Sayfa Ara..."
        >

    </div>

    {{-- Navigation --}}
    <div class="sidebar-menu">

        <button class="sidebar-item active" type="button">

            <span class="sidebar-item-icon">📄</span>

            <span>Sayfalar</span>

        </button>

        <button class="sidebar-item" type="button">

            <span class="sidebar-item-icon">🧩</span>

            <span>Modüller</span>

        </button>

        <button class="sidebar-item" type="button">

            <span class="sidebar-item-icon">🖼️</span>

            <span>Medya</span>

        </button>

        <button class="sidebar-item" type="button">

            <span class="sidebar-item-icon">⚙️</span>

            <span>Site Ayarları</span>

        </button>

    </div>

    <div class="sidebar-divider"></div>

    {{-- Pages --}}
    <div class="sidebar-pages">

        @foreach($builder['pages'] as $page)

            <a
                href="{{ route('tenant.builder', ['page' => $page->slug]) }}"
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

                {{-- Şimdilik sadece ikon.
                     Daha sonra dropdown olacak. --}}
                <span
                    class="page-actions-btn"
                    aria-hidden="true"
                >
                    ⋮
                </span>

            </a>

        @endforeach

    </div>

    {{-- Footer --}}
    <div class="sidebar-footer">

        <button
            class="new-page-btn"
            type="button"
        >

            + Yeni Sayfa

        </button>

    </div>

</aside>