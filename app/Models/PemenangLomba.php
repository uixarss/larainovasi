<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemenangLomba extends Model
{
    protected $fillable = [
        'lomba_id','peserta_id',
        'urutan', 'title','keterangan'
    ];
}
