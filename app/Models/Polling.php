<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Polling extends Model
{
    protected $fillable = [
        'name', 'author_id', 'description', 'status', 'expire_date', 'thumbnail', 'slug'
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function reponses()
    {
        return $this->hasMany(PollingResponse::class);
    }
    // public function user()
    // {
    //     return $this->hasMany(User::class);
    // }
}
