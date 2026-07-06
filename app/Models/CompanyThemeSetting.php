<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyThemeSetting extends Model
{
    protected $fillable = [
        'company_id',
        'theme_id',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}