<div class="preview-card">
    <div class="preview-header">
        <div class="preview-left">
            <div class="preview-title">
                <i class="fa-solid fa-eye"></i>
                <span>Canlı Önizleme</span>
            </div>
            <button class="device-btn active" data-device="desktop">
                <i class="fa-solid fa-desktop"></i>
                Masaüstü
            </button>
            <button class="device-btn" data-device="tablet" >
                <i class="fa-solid fa-tablet-screen-button"></i>
                Tablet
            </button>
            <button class="device-btn" data-device="mobile">
                <i class="fa-solid fa-mobile-screen-button"></i>
                Mobil
            </button>
        </div>
        
    </div>

    <div class="browser-frame" id="browserFrame">
        <div class="browser-top">
            <div class="browser-dots">
                <span class="dot red"></span>
                <span class="dot yellow"></span>
                <span class="dot green"></span>
            </div>
            <div class="browser-url">
                http://127.0.0.1:8000/site/{{ $company->slug }}
            </div>
        </div>

        <iframe id="previewFrame" src="/site/{{ $company->slug }}"></iframe>
    </div>
</div>
