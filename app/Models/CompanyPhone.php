<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyPhone extends Model
{
    protected $table = 'company_phones';
    protected $fillable = ['company_id', 'type', 'number'];

    // Bir telefon numarası bir firmaya aittir (İlişki)
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
