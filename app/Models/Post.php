<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory , SoftDeletes;

    protected $fillable = ['user_id', 'title', 'slug' ,'excerpt' ,'content' ,'featured_image','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
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
