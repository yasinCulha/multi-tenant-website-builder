<aside class="builder-sidebar" data-builder-sidebar>

    <div class="sidebar-search">
        <input
            type="text"
            placeholder="Sayfa Ara..."
            data-page-search
        >
    </div>

    <section class="sidebar-panel">

        <button class="sidebar-panel-title" data-sidebar-toggle="pages">
            <div class="sidebar-panel-left">
                <span class="sidebar-item-icon">P</span>
                <span>Sayfalar</span>
            </div>

            <span class="sidebar-chevron">⌄</span>
        </button>

        <div class="sidebar-pages" data-page-list>
            @foreach($builder['pages'] as $page)
                @php
                    $isCurrentPage = $builder['currentPage']?->id === $page->id;
                @endphp

                <div
                    class="page-item {{ $isCurrentPage ? 'active' : '' }}"
                    data-page-id="{{ $page->id }}"
                    data-page-title="{{ $page->title }}"
                    data-page-slug="{{ $page->slug }}"
                >
                    <a
                        href="{{ route('tenant.builder', ['page' => $page->slug]) }}"
                        class="page-info"
                        data-page-link
                        data-page-id="{{ $page->id }}"
                        data-page-title="{{ $page->title }}"
                        data-page-slug="{{ $page->slug }}"
                    >
                        <span class="page-item-title">{{ $page->title }}</span>
                        <span class="page-item-meta">/{{ $page->slug }}</span>
                    </a>

                    <button
                        class="page-delete-btn"
                        type="button"
                        aria-label="{{ $page->title }} sayfasini sil"
                        data-delete-page
                        data-page-id="{{ $page->id }}"
                    >
                        x
                    </button>
                </div>
            @endforeach
        </div>

        <button class="new-page-btn" type="button" data-open-new-page-modal>
            + Yeni Sayfa
        </button>
    </section>

    <div class="sidebar-divider"></div>

    <section class="sidebar-panel sidebar-modules-panel">
        <button class="sidebar-panel-title" data-sidebar-toggle="modules">

            <div class="sidebar-panel-left">
                <span class="sidebar-item-icon">M</span>
                <span>Modüller</span>
            </div>

            <span class="sidebar-chevron">⌄</span>

        </button>

        <div class="sidebar-modules" data-available-modules>
            @forelse($builder['availableModules'] as $module)
                <button
                    class="available-module-item"
                    type="button"
                    draggable="true"
                    data-add-module
                    data-module-id="{{ $module->id }}"
                    data-module-name="{{ $module->name }}"
                    data-module-view="{{ $module->view_path }}"
                >
                    <span class="available-module-icon">
                        {{ $module->icon ?: strtoupper(mb_substr($module->name, 0, 1)) }}
                    </span>
                    <span>{{ $module->name }}</span>
                </button>
            @empty
                <div class="sidebar-empty-state">
                    Bu tema icin modul bulunamadi.
                </div>
            @endforelse
        </div>
    </section>

</aside>
