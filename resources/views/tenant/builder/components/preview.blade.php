<main class="builder-preview">

    <div class="website-canvas">

        @php
            $company = $builder['company'];
            $theme = $builder['theme'];
            $settings = [];
            $themeFolder = $theme->folder_path;
            $previewUrl = 'https://' . $company->slug . '.apollonmedya.net';
        @endphp

        @vite("resources/views/tenant/website/themes/{$themeFolder}/assets/css/app.css")

        <div class="browser-frame">

            <div class="browser-toolbar">
                <div class="browser-actions" aria-hidden="true">
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

                @forelse($builder['pageModules'] as $pageModule)

                    @php
                        $module = $pageModule->module;
                        $moduleView = trim($module->view_path ?? '');
                        $moduleSlug = \Illuminate\Support\Str::slug($module->name);
                        $candidateViews = array_filter([
                            $moduleView,
                            $moduleView ? "tenant.website.themes.{$themeFolder}.components.{$moduleView}.index" : null,
                            "tenant.website.themes.{$themeFolder}.components.{$moduleSlug}.index",
                        ]);
                        $builderModuleView = collect($candidateViews)->first(fn ($view) => view()->exists($view));
                    @endphp

                    <section class="builder-module-shell {{ $loop->first ? 'is-selected' : '' }}" tabindex="0">

                        <div class="module-selection-label">
                            {{ $module->name }}
                        </div>

                        <div class="module-actions" aria-hidden="true">
                            <button type="button">Edit</button>
                            <button type="button">Duplicate</button>
                            <button type="button">Delete</button>
                        </div>

                        @if($builderModuleView)
                            @include($builderModuleView, [
                                'company' => $company,
                                'settings' => $settings,
                                'theme' => $theme,
                                'pageModule' => $pageModule,
                                'module' => $module,
                            ])
                        @else
                            <div class="module-missing-view">
                                {{ $module->name }} view bulunamadi.
                            </div>
                        @endif

                    </section>

                @empty

                    <div class="empty-canvas">
                        Bu sayfada henuz modul yok.
                    </div>

                @endforelse

            </div>

        </div>

    </div>

</main>
