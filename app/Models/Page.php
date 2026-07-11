<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use App\Models\PageModule;

class Page extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'slug',
    ];
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function pageModules()
    {
        return $this->hasMany(PageModule::class);
    }
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
