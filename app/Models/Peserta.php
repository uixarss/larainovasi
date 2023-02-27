<?php

namespace App\Models;

use App\User;
use App\Models\Lomba;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = [
        'user_id', 'no_hp',
        'tempat_lahir', 'tanggal_lahir',
        'alamat', 'nama_institusi', 'alamat_institusi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lomba()
    {
        return $this->belongsToMany(Lomba::class,'peserta_lombas','peserta_id','lomba_id')->withPivot([
            'nama_dokumen_lomba', 'kode_peserta', 'lokasi_dokumen_lomba', 'judul_dokumen_lomba','id'
        ]);
    }
}
