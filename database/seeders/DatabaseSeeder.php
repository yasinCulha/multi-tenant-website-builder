<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Theme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Örnek Temaları Oluşturuyoruz
        Theme::create([
            'name' => 'Kurumsal Mavi',
            'folder_path' => 'themes.corporate_blue'
        ]);

        Theme::create([
            'name' => 'Karanlık Modern (Dark)',
            'folder_path' => 'themes.modern_dark'
        ]);

        // 2. Senin Giriş Yapacağın Ana Admin Hesabını Oluşturuyoruz
        User::create([
            'name' => 'Sistem Admini',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'), // Giriş şifren
            'role' => 'admin',
            'company_id' => null
        ]);
    }
}