<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageModuleContent extends Model
{
    protected $fillable = [
        'page_module_id',
        'field_key',
        'field_value',
    ];

    public function pageModule(): BelongsTo
    {
        return $this->belongsTo(PageModule::class);
    }
}
