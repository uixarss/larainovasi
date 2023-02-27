<?php

namespace App\Models;

use App\Models\InovasiDaerah;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    //
    protected $table = 'rewards';

    protected $fillable = [
        'id_inovasi', 'nominal', 'kd_dana',
        'nama_dana', 'urut_dana', 'tipe',
        'tahun', 'keterangan'
    ];


    public function inovasi()
    {
        return $this->belongsTo(InovasiDaerah::class,'id_inovasi','id');
    }
}
