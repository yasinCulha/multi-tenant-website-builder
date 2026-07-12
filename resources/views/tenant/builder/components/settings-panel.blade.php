<div class="builder-settings" data-builder-settings>

    @php
        $selectedModule = $builder['pageModules']->first();
    @endphp

    @if(($builder['currentPage'] ?? null) && $builder['pageModules']->isEmpty())

        <div class="settings-header">
            <span class="settings-kicker">Boş Sayfa</span>
            <h3>{{ $builder['currentPage']->title }}</h3>
        </div>

        <div class="settings-empty-state">
            Bu sayfa boş. Soldaki Modüller bölümünden bir modül ekleyerek başlayabilirsiniz.
        </div>

    @elseif($selectedModule)

        <div class="settings-header">
            <span class="settings-kicker">Seçili Modül</span>

            <h3>
                {{ $selectedModule->themeModule->name }}
            </h3>
        </div>

        <div class="settings-body">

            {{-- Başlık --}}
            <div class="settings-section">

                <label>Başlık</label>

                <input
                    type="text"
                    class="settings-input"
                    name="title"
                    placeholder="Başlık giriniz..."
                >

            </div>

            {{-- Alt Başlık --}}
            <div class="settings-section">

                <label>Alt Başlık</label>

                <textarea
                    class="settings-textarea"
                    name="subtitle"
                    rows="5"
                    placeholder="Alt başlık giriniz..."
                ></textarea>

            </div>

            {{-- Buton Yazısı --}}
            <div class="settings-section">

                <label>Buton Yazısı</label>

                <input
                    type="text"
                    class="settings-input"
                    name="button_text"
                    placeholder="Teklif Al"
                >

            </div>

            {{-- Buton Linki --}}
            <div class="settings-section">

                <label>Buton Linki</label>

                <input
                    type="text"
                    class="settings-input"
                    name="button_url"
                    placeholder="/iletisim"
                >

            </div>

            {{-- Resim --}}
            <div class="settings-section">

                <label>Resim</label>

                <button
                    type="button"
                    class="settings-upload-btn"
                >
                    <i class="fa-solid fa-image"></i>
                    Resim Seç
                </button>

            </div>

        </div>

    @else

        <div class="settings-header">
            <span class="settings-kicker">Builder</span>
            <h3>Modül Seçilmedi</h3>
        </div>

        <div class="settings-empty-state">
            Önizleme alanından bir modül seçerek düzenlemeye başlayabilirsiniz.
        </div>

    @endif

</div>