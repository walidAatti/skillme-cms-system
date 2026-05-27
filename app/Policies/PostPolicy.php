<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): bool
    {
        // everyone can see published posts
        if ($post->status === 'published') {
            return true;
        }
        
        // Owner can view own unpublished post
        return $user && $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        // admin can edit everything
        if ($user->role === "admin") {
            return true;
        }

        // Owner Can edit his own Post
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        // admin can delete anything
        if ($user->role == "admin") {
            return true;
        }

        // Owner Can edit his own Post
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        // admin can restore anything
        if ($user->role === "admin") {
            return true;
        }
        return false;
    }


    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        // admin can restore anything
        if ($user->role === "admin") {
            return true;
        }
        return false;
    }
}
