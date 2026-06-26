<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySocialMedia extends Model
{
    protected $table = 'company_social_medias';
    protected $fillable = ['company_id', 'platform', 'url'];

    // Bir sosyal medya hesabı bir firmaya aittir (İlişki)
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
