<?php

namespace App\Models;

use Dom\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = ['title', 'slug' ,'excerpt' ,'content' ,'featured_image','status'];

    function categories() {
        return $this->belongsToMany(Category::class);
    }

    function tags() {
        return $this->belongsToMany(Tag::class);
    }

    function comments() {
        return $this->hasMany(Comment::class);
    }

}
