<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageModule extends Model
{
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

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
