@php
    // Modul icerigi oncelikle page_module_contents verisinden okunur.
    $content = $content ?? [];
@endphp

<section id="iletisim" class="md-contact">
    <div class="md-container md-contact__grid">
        <div>
            <span class="md-eyebrow">{{ data_get($content, 'eyebrow', 'Contact') }}</span>
            <h2>{{ data_get($content, 'section_title', data_get($settings ?? [], 'contact.section_title', 'Bir sonraki projeyi konusalim')) }}</h2>
            <p>{{ data_get($content, 'section_subtitle', data_get($settings ?? [], 'contact.section_subtitle', 'Kisa bir mesaj birakin, size en uygun yol haritasiyla donelim.')) }}</p>
        </div>
        <form class="md-form" method="post" action="#">
            <input type="text" name="name" placeholder="{{ data_get($settings ?? [], 'contact.form_name_label', 'Adiniz Soyadiniz') }}">
            <input type="email" name="email" placeholder="{{ data_get($settings ?? [], 'contact.form_email_label', 'E-Posta Adresiniz') }}">
            <input type="text" name="subject" placeholder="{{ data_get($settings ?? [], 'contact.form_subject_label', 'Mesaj Konusu') }}">
            <textarea name="message" rows="5" placeholder="{{ data_get($settings ?? [], 'contact.form_message_label', 'Mesajiniz') }}"></textarea>
            <button class="md-button" type="submit">{{ data_get($content, 'form_submit_button', data_get($settings ?? [], 'contact.form_submit_button', 'Gonder')) }}</button>
        </form>
    </div>
</section>
