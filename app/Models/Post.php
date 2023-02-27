<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'slug', 'title', 'author_id', 'excerp', 'content', 'status', 'publish_date', 'thumbnail',
        'meta'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_posts', 'post_id', 'category_id');
    }
}
