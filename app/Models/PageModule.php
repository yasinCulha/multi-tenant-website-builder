<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageModule extends Model
{
    protected $fillable = [
        'company_id',
        'page_id',
        'theme_page_module_id',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'content' => 'array',
        'is_visible' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function themeModule()
{
    return $this->belongsTo(
        ThemePageModule::class,
        'theme_page_module_id'
    );
}
}