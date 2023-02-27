<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersyaratanLomba extends Model
{
    protected $fillable = [
        'lomba_id', 'urutan',
        'name', 'keterangan',
        'status'
    ];
}
