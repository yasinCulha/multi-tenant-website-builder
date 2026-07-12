@php
    // Modul icerigi oncelikle page_module_contents verisinden okunur.
    $content = $content ?? [];
@endphp

<section class="md-map">
    <div class="md-container">
        <div class="md-map__frame">
            <div>
                <span class="md-eyebrow">{{ data_get($content, 'eyebrow', 'Location') }}</span>
                <h2>{{ data_get($content, 'info_title', data_get($settings ?? [], 'contact.info_title', 'Iletisim Bilgileri')) }}</h2>
                <p>{{ data_get($content, 'description', (data_get($settings ?? [], 'general.company_name', $company->name ?? 'Firma') . ' ekibine ulasmak icin formu kullanabilirsiniz.')) }}</p>
            </div>
        </div>
    </div>
</section>
