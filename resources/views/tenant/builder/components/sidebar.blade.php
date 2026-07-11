<aside class="builder-sidebar">

    <div class="sidebar-search">
        <input
            type="text"
            placeholder="Sayfa Ara..."
        >
    </div>

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

    <div class="sidebar-pages">

        @foreach($builder['pageTree'] as $treeItem)
            @php
                $page = $treeItem['page'];
                $isCurrentPage = $builder['currentPage']?->id === $page->id;
            @endphp

            <details class="page-tree-item {{ $isCurrentPage ? 'active' : '' }}" {{ $isCurrentPage ? 'open' : '' }}>
                <summary>
                    <a
                        href="{{ route('tenant.builder', ['page' => $page->slug]) }}"
                        class="page-item {{ $isCurrentPage ? 'active' : '' }}"
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

                        <span
                            class="page-actions-btn"
                            aria-hidden="true"
                        >
                            ⋮
                        </span>
                    </a>
                </summary>

                <div class="page-module-tree">
                    @foreach($treeItem['modules'] as $moduleItem)
                        <div class="page-module-tree-item {{ $moduleItem['type'] === 'layout' ? 'is-layout' : '' }}">
                            <span class="page-module-dot"></span>
                            <span>{{ $moduleItem['title'] }}</span>
                        </div>
                    @endforeach
                </div>
            </details>

        @endforeach

    </div>

    <div class="sidebar-footer">
        <button
            class="new-page-btn"
            data-bs-toggle="modal"
            data-bs-target="#newPageModal">

            + Yeni Sayfa

        </button>
    </div>

</aside>
