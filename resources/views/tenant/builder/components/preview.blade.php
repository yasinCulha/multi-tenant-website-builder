<main class="builder-preview">

    @php
        $company = $builder['company'];
        $theme = $builder['theme'];
        $settings = [];
        $themeFolder = $theme->folder_path;
        $previewUrl = 'https://' . $company->slug . '.apollonmedya.net';
    @endphp

    @vite([
        'resources/css/app.css',
        "resources/css/themes/{$themeFolder}/app.css",
    ])

    <div class="website-canvas">

        <div class="browser-frame">

            <div class="browser-toolbar">

                <div class="browser-actions">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="browser-address">
                    {{ $previewUrl }}
                </div>

                <div class="browser-status">
                    Live Preview
                </div>

            </div>

            <div class="website-render">

                @includeIf("tenant.website.themes.{$themeFolder}.partials.navbar", [
                    'company' => $company,
                    'settings' => $settings,
                    'theme' => $theme,
                ])

                @forelse($builder['pageModules'] as $pageModule)

                    @php

                        $module = $pageModule->themeModule;

                        /*
                         |------------------------------------------
                         | Önce view_path kullan
                         | yoksa modül isminden slug üret
                         |------------------------------------------
                         */

                        $moduleSlug = $module?->view_path
                            ? trim($module->view_path)
                            : \Illuminate\Support\Str::slug($module?->name ?? '');

                        $builderModuleView =
                            str_starts_with($moduleSlug, 'tenant.')
                                ? $moduleSlug
                                : "tenant.website.themes.{$themeFolder}." . ltrim($moduleSlug, '.');

                    @endphp

                    <section
                        class="builder-module-shell {{ $loop->first ? 'is-selected' : '' }}"
                        data-module-id="{{ $module?->id }}"
                    >

                        {{-- Builder etiketi --}}
                        <div class="module-selection-label">

                            {{ $module?->name }}

                        </div>

                        {{-- Builder araçları --}}
                        <div class="module-actions">

                            <button type="button">
                                Edit
                            </button>

                            <button type="button">
                                Duplicate
                            </button>

                            <button type="button">
                                Delete
                            </button>

                        </div>

                        {{-- Theme Modülü --}}
                        @if(view()->exists($builderModuleView))

                            @include($builderModuleView, [

                                'company'    => $company,
                                'settings'   => $settings,
                                'theme'      => $theme,
                                'pageModule' => $pageModule,
                                'module'     => $module,

                            ])

                        @else

                            <div class="module-missing-view">

                                <strong>View bulunamadı</strong>

                                <br>

                                {{ $builderModuleView }}

                            </div>

                        @endif

                    </section>

                @empty

                    <div class="empty-canvas">

                        Bu sayfada henüz modül bulunmuyor.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</main>
