<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\ThemePage;
use App\Models\ThemePageModule;
use App\Models\ThemePageModuleField;
use Illuminate\Database\Seeder;

class ThemeTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedCorporateBlue();
        $this->seedModernDark();
    }

    /**
     * Corporate Blue Theme
     */
    private function seedCorporateBlue(): void
    {
        $theme = Theme::where('folder_path', 'corporate-blue')->first();

        if (!$theme) {
            return;
        }

        $this->createPage(
            $theme,
            'Ana Sayfa',
            'home',
            [
                ['Hero', 'modules.hero', 'fa-house'],
                ['Services', 'modules.services', 'fa-briefcase'],
                ['About', 'modules.about', 'fa-circle-info'],
                ['Footer', 'modules.footer', 'fa-bars'],
            ]
        );

        $this->createPage(
            $theme,
            'Hakkımızda',
            'about',
            [
                ['Hero', 'modules.hero', 'fa-house'],
                ['Team', 'modules.team', 'fa-users'],
                ['Footer', 'modules.footer', 'fa-bars'],
            ]
        );

        $this->createPage(
            $theme,
            'İletişim',
            'contact',
            [
                ['Hero', 'modules.hero', 'fa-house'],
                ['Contact Form', 'modules.contact-form', 'fa-envelope'],
                ['Map', 'modules.map', 'fa-map'],
                ['Footer', 'modules.footer', 'fa-bars'],
            ]
        );
    }

    /**
     * Modern Dark Theme
     */
    private function seedModernDark(): void
    {
        $theme = Theme::where('folder_path', 'modern-dark')->first();

        if (!$theme) {
            return;
        }

        $this->createPage(
            $theme,
            'Home',
            'home',
            [
                ['Hero', 'modules.hero', 'fa-house'],
                ['About', 'modules.about', 'fa-circle-info'],
                ['Footer', 'modules.footer', 'fa-bars'],
            ]
        );

        $this->createPage(
            $theme,
            'About',
            'about',
            [
                ['Hero', 'modules.hero', 'fa-house'],
                ['Team', 'modules.team', 'fa-users'],
                ['Footer', 'modules.footer', 'fa-bars'],
            ]
        );

        $this->createPage(
            $theme,
            'Contact',
            'contact',
            [
                ['Hero', 'modules.hero', 'fa-house'],
                ['Contact Form', 'modules.contact-form', 'fa-envelope'],
                ['Map', 'modules.map', 'fa-map'],
                ['Footer', 'modules.footer', 'fa-bars'],
            ]
        );
    }

    /**
     * Sayfa + Modüller oluştur
     */
    private function createPage(
        Theme $theme,
        string $title,
        string $slug,
        array $modules
    ): void {

        $page = ThemePage::firstOrCreate(
            [
                'theme_id' => $theme->id,
                'slug' => $slug,
            ],
            [
                'title' => $title,
            ]
        );

        $order = 10;

        foreach ($modules as $module) {

            $themeModule = ThemePageModule::firstOrCreate(
                [
                    'theme_page_id' => $page->id,
                    'view_path' => $module[1],
                ],
                [
                    'name' => $module[0],
                    'icon' => $module[2],
                    'order' => $order,
                ]
            );

            $this->seedModuleFields($themeModule);

            $order += 10;
        }
    }

    private function seedModuleFields(ThemePageModule $themeModule): void
    {
        
        $moduleKey = strtolower(str_replace(['modules.', '-'], ['', '_'], $themeModule->view_path));

        foreach ($this->fieldsFor($moduleKey) as $index => $field) {
            // Tema modulu hangi alanlarla editlenecek bilgisini veritabaninda tutar.
            ThemePageModuleField::updateOrCreate(
                [
                    'theme_page_module_id' => $themeModule->id,
                    'field_key' => $field['field_key'],
                ],
                [
                    'field_name' => $field['field_name'],
                    'type' => $field['type'],
                    'placeholder' => $field['placeholder'] ?? null,
                    'default_value' => $field['default_value'] ?? null,
                    'sort_order' => ($index + 1) * 10,
                    'is_required' => $field['is_required'] ?? false,
                ]
            );
            dd($field);
        }
    }

    private function fieldsFor(string $moduleKey): array
    {
        return match ($moduleKey) {
            'hero', 'hero2' => [
                ['field_key' => 'badge_text', 'field_name' => 'Rozet', 'type' => 'text', 'default_value' => 'Kurumsal Cozumler'],
                ['field_key' => 'title', 'field_name' => 'Baslik', 'type' => 'text', 'default_value' => 'Isinizi Dijital Dunyada Guvenle Buyutun', 'is_required' => true],
                ['field_key' => 'description', 'field_name' => 'Aciklama', 'type' => 'textarea', 'default_value' => 'Markaniz icin hizli, guvenilir ve olceklenebilir dijital deneyimler tasarliyoruz.'],
                ['field_key' => 'button_primary_text', 'field_name' => 'Birincil Buton Yazisi', 'type' => 'text', 'default_value' => 'Teklif Al'],
                ['field_key' => 'button_primary_url', 'field_name' => 'Birincil Buton Linki', 'type' => 'url', 'default_value' => '#iletisim'],
                ['field_key' => 'button_secondary_text', 'field_name' => 'Ikincil Buton Yazisi', 'type' => 'text', 'default_value' => 'Daha Fazla Bilgi'],
                ['field_key' => 'button_secondary_url', 'field_name' => 'Ikincil Buton Linki', 'type' => 'url', 'default_value' => '#hakkimizda'],
            ],
            'about' => [
                ['field_key' => 'eyebrow', 'field_name' => 'Ust Baslik', 'type' => 'text', 'default_value' => 'Hakkimizda'],
                ['field_key' => 'section_title', 'field_name' => 'Baslik', 'type' => 'text', 'default_value' => 'Teknoloji Dunyasinda Guvenilir Is Ortaginiz'],
                ['field_key' => 'description', 'field_name' => 'Aciklama', 'type' => 'textarea', 'default_value' => 'Kuruldugumuz gunden bu yana musterilerimizin dijital donusum yolculugunda yanlarinda yer aliyoruz.'],
                ['field_key' => 'stat_1_value', 'field_name' => 'Istatistik 1 Degeri', 'type' => 'text', 'default_value' => '100+'],
                ['field_key' => 'stat_1_label', 'field_name' => 'Istatistik 1 Etiketi', 'type' => 'text', 'default_value' => 'Tamamlanan Proje'],
                ['field_key' => 'stat_2_value', 'field_name' => 'Istatistik 2 Degeri', 'type' => 'text', 'default_value' => '50+'],
                ['field_key' => 'stat_2_label', 'field_name' => 'Istatistik 2 Etiketi', 'type' => 'text', 'default_value' => 'Mutlu Musteri'],
                ['field_key' => 'stat_3_value', 'field_name' => 'Istatistik 3 Degeri', 'type' => 'text', 'default_value' => '24/7'],
                ['field_key' => 'stat_3_label', 'field_name' => 'Istatistik 3 Etiketi', 'type' => 'text', 'default_value' => 'Aktif Destek'],
            ],
            'services' => [
                ['field_key' => 'eyebrow', 'field_name' => 'Ust Baslik', 'type' => 'text', 'default_value' => 'Hizmetler'],
                ['field_key' => 'section_title', 'field_name' => 'Baslik', 'type' => 'text', 'default_value' => 'Neden Bizimle Calismalisiniz?'],
                ['field_key' => 'section_subtitle', 'field_name' => 'Alt Baslik', 'type' => 'textarea', 'default_value' => 'Kurumsal ihtiyaclariniz icin yuksek standartlarda cozumler uretiyoruz.'],
                ['field_key' => 'item_1_title', 'field_name' => 'Kart 1 Baslik', 'type' => 'text', 'default_value' => 'Yuksek Guvenlik'],
                ['field_key' => 'item_1_desc', 'field_name' => 'Kart 1 Aciklama', 'type' => 'textarea', 'default_value' => 'Sistemlerinizi modern guvenlik yaklasimlariyla koruruz.'],
                ['field_key' => 'item_2_title', 'field_name' => 'Kart 2 Baslik', 'type' => 'text', 'default_value' => 'Tam Performans'],
                ['field_key' => 'item_2_desc', 'field_name' => 'Kart 2 Aciklama', 'type' => 'textarea', 'default_value' => 'Hizli, olceklenebilir ve stabil dijital altyapilar kurariz.'],
                ['field_key' => 'item_3_title', 'field_name' => 'Kart 3 Baslik', 'type' => 'text', 'default_value' => '7/24 Destek'],
                ['field_key' => 'item_3_desc', 'field_name' => 'Kart 3 Aciklama', 'type' => 'textarea', 'default_value' => 'Operasyonlariniz icin surekli destek ve danismanlik saglariz.'],
            ],
            'team' => [
                ['field_key' => 'eyebrow', 'field_name' => 'Ust Baslik', 'type' => 'text', 'default_value' => 'Ekip'],
                ['field_key' => 'section_title', 'field_name' => 'Baslik', 'type' => 'text', 'default_value' => 'Deneyimli ve odakli bir ekip'],
                ['field_key' => 'section_subtitle', 'field_name' => 'Alt Baslik', 'type' => 'textarea', 'default_value' => 'Strateji, tasarim ve teknoloji disiplinlerini tek hedef etrafinda birlestiriyoruz.'],
            ],
            'contact_form' => [
                ['field_key' => 'eyebrow', 'field_name' => 'Ust Baslik', 'type' => 'text', 'default_value' => 'Iletisim'],
                ['field_key' => 'section_title', 'field_name' => 'Baslik', 'type' => 'text', 'default_value' => 'Bizimle Iletisime Gecin'],
                ['field_key' => 'section_subtitle', 'field_name' => 'Alt Baslik', 'type' => 'textarea', 'default_value' => 'Projeniz icin kisa bir mesaj birakin, size donelim.'],
                ['field_key' => 'form_submit_button', 'field_name' => 'Gonder Butonu', 'type' => 'text', 'default_value' => 'Talebi Gonder'],
            ],
            'map' => [
                ['field_key' => 'eyebrow', 'field_name' => 'Ust Baslik', 'type' => 'text', 'default_value' => 'Lokasyon'],
                ['field_key' => 'info_title', 'field_name' => 'Baslik', 'type' => 'text', 'default_value' => 'Iletisim Bilgileri'],
                ['field_key' => 'description', 'field_name' => 'Aciklama', 'type' => 'textarea', 'default_value' => 'Gorusmek icin iletisim formunu kullanabilirsiniz.'],
            ],
            'footer' => [
                ['field_key' => 'copyright_text', 'field_name' => 'Telif Metni', 'type' => 'text', 'default_value' => 'Tum haklari saklidir.'],
            ],
            default => [],
        };
    }
}
