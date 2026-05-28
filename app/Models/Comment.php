<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = ['parent_id', 'content', 'status'];

    function post() {
        return $this->belongsTo(Post::class);
    }
    
    function user() {
        return $this->belongsTo(User::class);
    }

    // PARENT
    function parent() {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    
    // Child
    function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    
}
