<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function post()
    {
        return $this->belongsToMany(Post::class, 'category_posts', 'category_id', 'post_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeGetParent($query)
    {
        return $query->whereNull('parent_id');
    }


    // public function setSlugAttribute($value)
    // {
    //     $this->attributes['slug'] = Str::slug($value);
    // }


    // public function getNameAttribute($value)
    // {
    //     return ucfirst($value);
    // }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // public function product()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
