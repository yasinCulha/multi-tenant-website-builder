<header class="builder-topbar">

    <div class="topbar-left">

        <div class="builder-logo">
            A
        </div>

        <div class="builder-brand">

            <span class="brand-title">
                APOLLON Builder
            </span>

            <span class="brand-subtitle">
                Visual Website Builder
            </span>

        </div>

    </div>

    <div class="topbar-center">

        <button class="device active" type="button" aria-label="Desktop preview" data-preview-device="desktop">
            <span class="device-icon">D</span>
            <span>Desktop</span>
        </button>

        <button class="device" type="button" aria-label="Tablet preview" data-preview-device="tablet">
            <span class="device-icon">T</span>
            <span>Tablet</span>
        </button>

        <button class="device" type="button" aria-label="Mobile preview" data-preview-device="mobile">
            <span class="device-icon">M</span>
            <span>Mobile</span>
        </button>

    </div>

    <div class="topbar-right">

        <button
            class="btn-preview"
            type="button"
            data-live-preview-url="https://{{ $builder['company']->slug }}.apollonmedya.net">
            Preview
        </button>

        <button class="btn-save" type="button" data-builder-save>
            Save
        </button>

    </div>

</header>
