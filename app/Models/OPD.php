<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OPD extends Model
{
    protected $table = 'opdes';

    protected $fillable = [
        'name', 'created_by', 'updated_by', 'kd_unit', 'urut_unit',
        'nama_bid_urusan', 'urut_bid_urusan', 'kd_bid_urusan'
    ];

}
