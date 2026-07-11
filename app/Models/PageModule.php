<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'is_visible' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function themeModule(): BelongsTo
    {
        return $this->belongsTo(ThemePageModule::class, 'theme_page_module_id');
    }

    public function contents(): HasMany
    {
        return $this->hasMany(PageModuleContent::class);
    }

    public function getContentValue(string $key, mixed $default = null): mixed
    {
        return $this->contents->firstWhere('field_key', $key)?->field_value ?? $default;
    }
}
