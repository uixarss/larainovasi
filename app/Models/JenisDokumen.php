<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    protected $fillable = [
        'name'
    ];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }
}
