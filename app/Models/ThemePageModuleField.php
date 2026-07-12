<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThemePageModuleField extends Model
{
    protected $fillable = [
        'theme_page_module_id',
        'field_key',
        'field_name',
        'type',
        'placeholder',
        'default_value',
        'sort_order',
        'is_required',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function themePageModule(): BelongsTo
    {
        // Field tanimi ait oldugu tema modulune baglanir.
        return $this->belongsTo(ThemePageModule::class);
    }

    public function module(): BelongsTo
    {
        // Eski kullanimlar kirilmasin diye ayni iliski alias olarak korunur.
        return $this->themePageModule();
    }
}
