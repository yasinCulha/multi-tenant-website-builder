@php
    // Modul icerigi oncelikle page_module_contents verisinden okunur.
    $content = $content ?? [];
@endphp

<section id="hakkimizda" class="cb-about">
    <div class="cb-container cb-about__grid">
        <div>
            <span class="cb-eyebrow">{{ data_get($content, 'eyebrow', 'Hakkimizda') }}</span>
            <h2>{{ data_get($content, 'section_title', data_get($settings ?? [], 'about.section_title', 'Teknoloji Dunyasinda Guvenilir Is Ortaginiz')) }}</h2>
            <p>{{ data_get($content, 'description', data_get($settings ?? [], 'about.description', 'Kuruldugumuz gunden bu yana musterilerimizin dijital donusum yolculugunda yanlarinda yer aliyoruz.')) }}</p>
        </div>
        <div class="cb-about__stats">
            <div><strong>{{ data_get($content, 'stat_1_value', data_get($settings ?? [], 'about.stat_1_value', '100+')) }}</strong><span>{{ data_get($content, 'stat_1_label', data_get($settings ?? [], 'about.stat_1_label', 'Tamamlanan Proje')) }}</span></div>
            <div><strong>{{ data_get($content, 'stat_2_value', data_get($settings ?? [], 'about.stat_2_value', '50+')) }}</strong><span>{{ data_get($content, 'stat_2_label', data_get($settings ?? [], 'about.stat_2_label', 'Mutlu Musteri')) }}</span></div>
            <div><strong>{{ data_get($content, 'stat_3_value', data_get($settings ?? [], 'about.stat_3_value', '24/7')) }}</strong><span>{{ data_get($content, 'stat_3_label', data_get($settings ?? [], 'about.stat_3_label', 'Aktif Destek')) }}</span></div>
        </div>
    </div>
</section>
