<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Theme::create([
            'name' => 'Kurumsal Mavi',
            'folder_path' => 'themes.corporate-blue',
        ]);

        Theme::create([
            'name' => 'Karanlık Modern (Dark)',
            'folder_path' => 'themes.modern-dark',
        ]);
    }
}