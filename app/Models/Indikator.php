<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InovasiDaerah;
use App\Models\NilaiIndikator;
use App\Models\DokumenInovasiIndikator;
class Indikator extends Model
{
    protected $table = 'indikators';
    protected $fillable = [
        'nama', 'keterangan', 'jenis_file','data_pendukung'
    ];

    public function nilai()
    {
        return $this->hasMany(NilaiIndikator::class);
    }

    public function inovasi()
    {
        return $this->belongsToMany(InovasiDaerah::class,'inovasi_indikators','indikator_id','inovasi_id')->withPivot('bobot')->withTimestamps();
    }

    public function file()
    {
        return $this->belongsToMany(InovasiDaerah::class,'dokumen_inovasi_indikators','indikator_id', 'inovasi_id')->withPivot([
            'id', 'nomor_surat', 'tanggal_surat', 'tentang','nama_file', 'lokasi_file','inovasi_id'
        ]);
    }
}
