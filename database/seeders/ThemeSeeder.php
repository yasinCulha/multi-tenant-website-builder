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
            'slug' => 'kurumsal-mavi',
            'folder_path' => 'themes.corporate-blue',
        ]);

        Theme::create([
            'name' => 'Karanlık Modern (Dark)',
            'slug'=>'modern-dark',
            'folder_path' => 'themes.modern-dark',
        ]);
    }
}