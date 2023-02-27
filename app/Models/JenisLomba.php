<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisLomba extends Model
{
    protected $fillable = [
        'name', 'parent_id'
    ];
}
