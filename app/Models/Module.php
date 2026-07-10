<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function pageModules()
    {
        return $this->hasMany(PageModule::class);
    }
}
