@php
    // Modul icerigi oncelikle page_module_contents verisinden okunur.
    $content = $content ?? [];
@endphp

<section class="cb-team">
    <div class="cb-container">
        <div class="cb-section-heading">
            <span class="cb-eyebrow">{{ data_get($content, 'eyebrow', 'Ekip') }}</span>
            <h2>{{ data_get($content, 'section_title', 'Deneyimli ve odakli bir ekip') }}</h2>
            <p>{{ data_get($content, 'section_subtitle', 'Strateji, tasarim ve teknoloji disiplinlerini tek hedef etrafinda birlestiriyoruz.') }}</p>
        </div>
        <div class="cb-team__grid">
            <article class="cb-card"><h3>Strateji</h3><p>Is hedeflerinizi netlestiren yol haritalari.</p></article>
            <article class="cb-card"><h3>Tasarim</h3><p>Kullanici deneyimini one alan sade arayuzler.</p></article>
            <article class="cb-card"><h3>Teknoloji</h3><p>Surdurulebilir ve bakimi kolay sistemler.</p></article>
        </div>
    </div>
</section>
