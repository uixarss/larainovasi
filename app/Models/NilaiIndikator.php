<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Indikator;

class NilaiIndikator extends Model
{
    protected $table = 'nilai_indikators';

    protected $fillable = [
        'indikator_id','uraian','nilai'
    ];

    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }

}
