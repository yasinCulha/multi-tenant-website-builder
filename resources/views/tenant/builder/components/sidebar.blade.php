<aside class="builder-sidebar" data-builder-sidebar>

    <div class="sidebar-search">
        <input
            type="text"
            placeholder="Sayfa Ara..."
            data-page-search
        >
    </div>

    {{-- ==================== SAYFALAR ==================== --}}

    <section class="sidebar-panel open">

        <button
            class="sidebar-panel-title"
            type="button"
            data-sidebar-toggle="pages"
        >
            <div class="sidebar-panel-left">
                <span class="sidebar-item-icon">P</span>
                <span>Sayfalar</span>
            </div>

            <i class="fa-solid fa-chevron-down sidebar-chevron"></i>
        </button>

        <div class="sidebar-panel-content">

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
                            <span class="page-item-title">
                                {{ $page->title }}
                            </span>

                            <span class="page-item-meta">
                                /{{ $page->slug }}
                            </span>
                        </a>

                        <button
                            class="page-delete-btn"
                            type="button"
                            data-delete-page
                            data-page-id="{{ $page->id }}"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </div>

                @endforeach
                <button
                class="new-page-btn"
                type="button"
                data-open-new-page-modal
            >
                + Yeni Sayfa
            </button>

            </div>

            

        </div>

    </section>

    <div class="sidebar-divider"></div>

    {{-- ==================== MODÜLLER ==================== --}}

    <section class="sidebar-panel open sidebar-modules-panel">

        <button
            class="sidebar-panel-title"
            type="button"
            data-sidebar-toggle="modules"
        >
            <div class="sidebar-panel-left">
                <span class="sidebar-item-icon">M</span>
                <span>Modüller</span>
            </div>

            <i class="fa-solid fa-chevron-down sidebar-chevron"></i>
        </button>

        <div class="sidebar-panel-content">

            <div
                class="sidebar-modules"
                data-available-modules
            >

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
                            {{ $module->icon ?: strtoupper(mb_substr($module->name,0,1)) }}
                        </span>

                        <span>{{ $module->name }}</span>

                    </button>

                @empty

                    <div class="sidebar-empty-state">
                        Bu tema için modül bulunamadı.
                    </div>

                @endforelse

            </div>

        </div>

    </section>

</aside>