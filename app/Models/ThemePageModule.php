<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemePageModule extends Model
{
    protected $fillable = [
        'theme_page_id',
        'name',
        'view_path',
        'icon',
        'order',
    ];

    public function page()
    {
        return $this->belongsTo(ThemePage::class, 'theme_page_id');
    }
}