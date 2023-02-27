<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['question', 'polling_id'];

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }
    public function polling()
    {
        return $this->belongsTo(Polling::class);
    }
}
