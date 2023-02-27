<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Respon extends Model
{
    protected $fillable = [
        'pengaduan_id', 'user_id',
        'respon', 'status'
    ];


    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class,'pengaduan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
