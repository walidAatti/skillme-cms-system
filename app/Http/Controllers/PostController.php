<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    
    // READ (Index) - List all posts
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        $posts = Post::with(['categories', 'tags'])->where('status', 'published')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // CREATE (Form) - Show form to create a post
    public function create(Request $request)
    {
        $this->authorize('create', Post::class);
        $categories = Category::all();
        $tags = Tag::all();
        $redirect = $request->redirect;
        return view('posts.create', compact('categories', 'tags', 'redirect'));
    }

    // CREATE (Store) - Save the new post
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload if present
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        // Update Tags
        $tagIds = [];

        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate([
                'name' => $tagName,
                'slug' => Str::slug($tagName)
            ]);

            $tagIds[] = $tag->id;
        }

        $post = Post::create($validated);

        // Sync many-to-many relationships
        $post->categories()->sync($request->categories);
        $post->tags()->sync($tagIds);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // READ (Show) - View a single post
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        $post->load(['categories', 'tags', 'comments']);
        return view('posts.show', compact('post'));
    }

    // UPDATE (Form) - Show form to edit an existing post
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    // UPDATE (Update) - Save changes to the post
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validated();


        // Handle image update
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            } 
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        // FEATURED IMage deletion 
        if ($request->boolean('remove_featured_image')) {
            Storage::disk('public')->delete($post->featured_image);
            $validated['featured_image'] = null;
        }


        // Update Tags
        $tagIds = [];

        if(!empty($request->tags)) {
            foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate([
                'name' => $tagName,
                'slug' => Str::slug($tagName)
            ]);

            $tagIds[] = $tag->id;
        }
        }

        

        $post->update($validated);

        // Sync updated relationships
        $post->categories()->sync($request->categories);
        $post->tags()->sync($tagIds);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // DELETE - Remove the post
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}