<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
      'name', 'jenis_dokumen_id',
      'nama_file', 'lokasi_file'
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisDokumen::class,'jenis_dokumen_id', 'id');
    }
}
