<main class="builder-preview">

    @php
        $company = $builder['company'];
        $theme = $builder['theme'];
        $settings = $builder['settings'] ?? [];
        $themeFolder = $theme->folder_path;
        $currentPage = $builder['currentPage'];
        $previewUrl = 'https://' . $company->slug . '.apollonmedya.net'
            . ($currentPage ? '?page=' . $currentPage->slug : '');
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

                @include("tenant.website.themes.{$themeFolder}._modules", [
                    'company' => $company,
                    'settings' => $settings,
                    'theme' => $theme,
                    'currentPage' => $currentPage,
                    'pageModules' => $builder['pageModules'],
                    'isBuilderPreview' => true,
                ])

            </div>

        </div>

    </div>

</main>
