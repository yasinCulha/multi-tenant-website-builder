@forelse($pageModules ?? collect() as $pageModule)
    @php
        $module = $pageModule->themeModule;
        $moduleView = $module?->view_path
            ? 'tenant.website.themes.corporate-blue.' . ltrim(trim($module->view_path), '.')
            : null;
        $isBuilderPreview = $isBuilderPreview ?? false;
    @endphp

    @if($moduleView && view()->exists($moduleView))
        @if($isBuilderPreview)
            <section
                class="builder-module-shell {{ $loop->first ? 'is-selected' : '' }}"
                data-module-id="{{ $module?->id }}"
                data-page-module-id="{{ $pageModule->id }}"
            >
                <div class="module-selection-label">{{ $module?->name }}</div>

                <div class="module-actions">
                    <button type="button">Edit</button>
                    <button type="button">Duplicate</button>
                    <button type="button" data-delete-page-module="{{ $pageModule->id }}">Delete</button>
                </div>

                @include($moduleView, [
                    'company' => $company,
                    'settings' => $settings ?? [],
                    'pageModule' => $pageModule,
                    'module' => $module,
                ])
            </section>
        @else
            @include($moduleView, [
                'company' => $company,
                'settings' => $settings ?? [],
                'pageModule' => $pageModule,
                'module' => $module,
            ])
        @endif
    @elseif($isBuilderPreview)
        <div class="module-missing-view">
            <strong>View bulunamadi</strong>
            <br>
            {{ $moduleView }}
        </div>
    @endif
@empty
    @if($isBuilderPreview)
        <div class="empty-canvas">
            Bu sayfada henuz modul bulunmuyor.
        </div>
    @endif
@endforelse
