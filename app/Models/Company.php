<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = ['name', 'slug', 'theme_id'];

    // Bir firma bir temaya aittir (İlişki)
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }
    // Bir firmanın birden fazla kullanıcısı olabilir
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    // Bir firmanın birden fazla sosyal medya hesabı olabilir
    public function socialMedias(): HasMany
    {
        return $this->hasMany(CompanySocialMedia::class);
    }
    // Bir firmanın birden fazla telefon numarası olabilir
    public function phones(): HasMany{
        
        return $this->hasMany(CompanyPhone::class);
    }
    public function themeSetting()
    {  
        return $this->hasOne(CompanyThemeSetting::class);
    }
    public function pageModules()
    {
        return $this->hasMany(PageModule::class);
    }
}