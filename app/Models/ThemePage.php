<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemePage extends Model
{
    protected $fillable = [
        'theme_id',
        'title',
        'slug',
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function modules()
    {
        return $this->hasMany(ThemePageModule::class);
    }
}