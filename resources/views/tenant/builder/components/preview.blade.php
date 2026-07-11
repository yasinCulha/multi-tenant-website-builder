<main class="builder-preview">

    @php
        $company = $builder['company'];
        $currentPage = $builder['currentPage'];
        $previewUrl = route('builder.preview', [
            'page' => $currentPage?->slug,
            'v' => $currentPage?->updated_at?->timestamp ?? time(),
        ]);
    @endphp

    <div class="website-canvas" data-preview-canvas>

        <div class="browser-frame">

            <div class="browser-toolbar">

                <div class="browser-actions">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="browser-address" data-preview-address>
                    {{ $previewUrl }}
                </div>

                <div class="browser-status">
                    Builder Preview
                </div>

            </div>

            <iframe
                class="website-render website-render-frame"
                title="Builder Preview"
                src="{{ $previewUrl }}"
                data-builder-preview-frame
            ></iframe>

        </div>

    </div>

</main>
