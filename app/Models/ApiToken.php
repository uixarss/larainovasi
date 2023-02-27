<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class ApiToken extends Authenticatable
{
    protected $fillable = [
        'nama_domain', 'ip_address',
        'api_token', 'expired_at'
    ];
}
