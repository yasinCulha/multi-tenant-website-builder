<div class="editor-navbar">
        <div class="editor-left">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Temalara Dön</span>
            </a>
        </div>
        <div class="editor-center">
            <h4>{{ $theme->name }}</h4>
            <small>Tema Düzenleyici</small>
        </div>
        <div class="editor-right">
            <button class="btn-save" id="saveThemeButton">
                <i class="fa-solid fa-floppy-disk"></i>
                Kaydet
            </button>
            <a href="/site/{{ $company->slug }}" target="_blank" class="btn-preview">
                <i class="fa-solid fa-eye"></i>
                Siteyi Görüntüle
            </a>
        </div>
    </div>
</div>