<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class ThemeManager
{
    protected string $themePath;
    // public function defaults(...);

    public function __construct()
    {
        $this->themePath = resource_path('views/themes');
    }

    /**
     * Bütün temaları getir
     */
    public function all()
    {
        $themes = [];

        foreach (File::directories($this->themePath) as $directory) {

            $manifest = $directory . '/manifest.json';

            if (!File::exists($manifest)) {
                continue;
            }

            $themes[] = json_decode(File::get($manifest), true);
        }

        return $themes;
    }

    /**
     * Tema bilgisi
     */
    public function find(string $slug)
    {
        $manifest = $this->themePath . "/{$slug}/manifest.json";

        if (!File::exists($manifest)) {
            return null;
        }

        return json_decode(File::get($manifest), true);
    }

    /**
     * Default ayarlar
     */
    public function defaults(string $slug)
    {
        $file = $this->themePath . "/{$slug}/default.json";


        if (!File::exists($file)) {
            return [];
        }

        return json_decode(File::get($file), true);
    }

    /**
     * Editör şeması
     */
    public function editor(string $slug)
    {
        $file = $this->themePath . "/{$slug}/editor.json";
        dd($file, File::exists($file));


        if (!File::exists($file)) {
            return [];
        }

        return json_decode(File::get($file), true);
    }

    /**
     * Blade yolu
     */
    public function blade(string $slug)
    {
        return resource_path("views/themes/{$slug}/index.blade.php");
    }
}