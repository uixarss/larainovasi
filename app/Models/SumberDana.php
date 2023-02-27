<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    protected $fillable = [
        'kd_dana', 'urut_dana',
        'nama_dana', 'tipe'
    ];
}
