<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    // Güvenlik için formlardan toplu veri girilmesine izin verdiğimiz alanlar
    protected $fillable = ['name', 'slug', 'folder_path'];

    // Bir temanın birden fazla firması olabilir (İlişki)
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
    public function companyThemeSettings()
    {
        return $this->hasMany(CompanyThemeSetting::class);
    }

    /**
     * @deprecated Company pages are installed from templatePages().
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * @deprecated Theme modules are scoped through templatePages()->modules().
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function templatePages(): HasMany
    {
        return $this->hasMany(ThemePage::class);
    }

    public function templateModules()
    {
        return $this->hasManyThrough(ThemePageModule::class, ThemePage::class);
    }
}
