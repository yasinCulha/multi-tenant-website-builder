<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    // Güvenlik için formlardan toplu veri girilmesine izin verdiğimiz alanlar
    protected $fillable = ['name', 'folder_path'];

    // Bir temanın birden fazla firması olabilir (İlişki)
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}