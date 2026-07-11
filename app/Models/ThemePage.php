<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThemePage extends Model
{
    protected $fillable = [
        'theme_id',
        'title',
        'slug',
    ];

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function modules(): HasMany
    {
        return $this->hasMany(ThemePageModule::class);
    }
}
