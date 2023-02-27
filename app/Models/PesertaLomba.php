<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peserta;
class PesertaLomba extends Model
{
    protected $fillable = [
        'peserta_id', 'lomba_id',
        'kode_peserta', 'judul_dokumen_lomba',
        'nama_dokumen_lomba', 'lokasi_dokumen_lomba'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'id');
    }
}
