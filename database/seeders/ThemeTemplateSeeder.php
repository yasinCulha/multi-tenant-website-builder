<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\ThemePage;
use App\Models\ThemePageModule;
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

            ThemePageModule::firstOrCreate(
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

            $order += 10;
        }
    }
}