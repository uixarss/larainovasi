<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JenisLomba;
use App\Models\PersyaratanLomba;
use App\Models\Peserta;
class Lomba extends Model
{
    protected $fillable = [
        'title', 'jenis_lomba_id',
        'mulai_acara', 'selesai_acara',
        'penyelenggara', 'mulai_daftar',
        'selesai_daftar', 'target_peserta',
        'nama_thumbnail', 'lokasi_thumbnail',
        'lokasi_acara', 'deskripsi_acara',
        'file_mekanisme', 'lokasi_file_mekanisme',
        'status'
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisLomba::class,'jenis_lomba_id', 'id');
    }

    public function syarat()
    {
        return $this->hasMany(PersyaratanLomba::class);
    }

    public function peserta()
    {
        return $this->belongsToMany(Peserta::class,'peserta_lombas', 'lomba_id','peserta_id')
            ->withPivot(['kode_peserta', 'judul_dokumen_lomba', 'nama_dokumen_lomba','peserta_id']);
    }

    public function pemenang()
    {
        return $this->belongsToMany(Peserta::class,'pemenang_lombas','lomba_id', 'peserta_id')
            ->withPivot([
                'urutan', 'title', 'keterangan', 'id'
            ]);
    }
}
