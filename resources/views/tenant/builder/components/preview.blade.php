<main class="builder-preview">

    @php
        $company = $builder['company'];
        $currentPage = $builder['currentPage'];
        $previewUrl = 'https://' . $company->slug . '.apollonmedya.net'
            . ($currentPage ? '?page=' . $currentPage->slug : '');
    @endphp

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
                    Builder Preview
                </div>

            </div>

            <iframe
                class="website-render website-render-frame"
                title="Builder Preview"
                srcdoc="{{ e($builder['previewHtml'] ?? '') }}"
            ></iframe>

        </div>

    </div>

</main>
