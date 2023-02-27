<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Indikator;
use App\Models\Reward;
use App\User;

class InovasiDaerah extends Model
{
    //

    protected $dates = ['created_at', 'updated_at','waktu_uji_coba','waktu_implementasi'];

    public function indikator()
    {
        return $this->belongsToMany(Indikator::class,'inovasi_indikators','inovasi_id','indikator_id')->withPivot('bobot');
    }

    public function reward()
    {
        return $this->hasMany(Reward::class,'id_inovasi','id');
    }

    public function dokumen()
    {
        return $this->belongsToMany(Indikator::class,'dokumen_inovasi_indikators','inovasi_id','indikator_id')
        ->withPivot(['nomor_surat','tanggal_surat','tentang','nama_file','lokasi_file'])
        ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by', 'id');
    }

    public function skpd()
    {
        return $this->belongsTo(OPD::class, 'opd_id', 'id');
    }
}
