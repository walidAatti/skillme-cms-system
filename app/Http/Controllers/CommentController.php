<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    { 

        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:600'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        $post->comments()->create([
            'user_id' => Auth::user()->id,
            'parent_id' => $request->parent_id,
            'content' => $validated['comment'],
        ]);
        

        return back()->with('comment', 'Comment added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back()->with('comment_deleted', 'Comment deleted successfully');
    }
}
