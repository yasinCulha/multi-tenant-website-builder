<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use App\Models\PageModule;

class Page extends Model
{
    public function theme()
    {
        return $this->belongsTo(Theme::class);
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
