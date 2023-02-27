<?php

namespace App\Models;

use Dompdf\Options;
use Illuminate\Database\Eloquent\Model;

class PollingResponse extends Model
{
    protected $table = 'polling_response';

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function option()
    {
        return $this->belongsTo(QuestionOption::class);
    }
}
