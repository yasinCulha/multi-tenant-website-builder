@php
    // Modul icerigi oncelikle page_module_contents verisinden okunur.
    $content = $content ?? [];
@endphp

<section class="md-team">
    <div class="md-container">
        <div class="md-section-heading">
            <span class="md-eyebrow">{{ data_get($content, 'eyebrow', 'Team') }}</span>
            <h2>{{ data_get($content, 'section_title', 'Kod, tasarim ve strateji ayni masada') }}</h2>
            <p>{{ data_get($content, 'section_subtitle', 'Modern SaaS urunleri icin hizli karar alan, temiz ureten bir ekip modeli.') }}</p>
        </div>
        <div class="md-team__grid">
            <article class="md-glass-card"><h3>Product</h3><p>Net kapsam, dogru oncelik ve hizli iterasyon.</p></article>
            <article class="md-glass-card"><h3>Design</h3><p>Karanlik temaya yakisan keskin ve okunur arayuzler.</p></article>
            <article class="md-glass-card"><h3>Engineering</h3><p>Bakimi kolay, olceklenebilir frontend ve backend temelleri.</p></article>
        </div>
    </div>
</section>
