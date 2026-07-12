@php
    // Modul icerigi oncelikle page_module_contents verisinden okunur.
    $content = $content ?? [];
@endphp

<section class="cb-map">
    <div class="cb-container">
        <div class="cb-map__frame">
            <div>
                <span class="cb-eyebrow">{{ data_get($content, 'eyebrow', 'Lokasyon') }}</span>
                <h2>{{ data_get($content, 'info_title', data_get($settings ?? [], 'contact.info_title', 'Iletisim Bilgileri')) }}</h2>
                <p>{{ data_get($content, 'description', (data_get($settings ?? [], 'general.company_name', $company->name ?? 'Firma') . ' ile gorusmek icin iletisim formunu kullanabilirsiniz.')) }}</p>
            </div>
        </div>
    </div>
</section>
