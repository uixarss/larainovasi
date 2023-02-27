<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'name', 'email', 'no_hp',
        'title', 'body', 'status',
        'nama_file', 'lokasi_file'
    ];

    public function respons()
    {
        return $this->hasMany(Respon::class);
    }
}
