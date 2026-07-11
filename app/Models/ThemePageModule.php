<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThemePageModule extends Model
{
    protected $fillable = [
        'theme_page_id',
        'name',
        'view_path',
        'icon',
        'order',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(ThemePage::class, 'theme_page_id');
    }

    public function pageModules(): HasMany
    {
        return $this->hasMany(PageModule::class);
    }
}
