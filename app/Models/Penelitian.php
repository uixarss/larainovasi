<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    //
    protected $fillable = [
        'title', 'abstract', 'description', 'keyword',
        'author', 'institution', 'status', 'file_name_full_article',
        'loc_file_name_full_article', 'upload_by', 'publish_by',
        'created_at', 'updated_at'
    ];

    public function penelitian(){
        $this->belongsTo(Penelitian::class);
    }
}
