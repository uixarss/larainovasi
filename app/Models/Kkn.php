<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kkn extends Model
{
    protected $fillable = [
        'title', 'description',
        'author', 'institution', 'status', 'file_name_doc',
        'loc_file_name_doc', 'upload_by', 'publish_by',
        'created_at', 'updated_at'
    ];

    public function kkn(){
        $this->belongsTo(KKN::class);
    }
}
