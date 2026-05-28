<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create();

        // adding myemail for testing
        User::firstOrCreate(
            ['email' => 'adminwalid@gmail.com'],
            [
            'name' => 'walid admin',
            'password' => bcrypt('walid000'),
            'role' => 'admin'
        ]);

        // adding myemail for testing
        User::firstOrCreate(
            ['email' => 'walidaatti1@gmail.com'],
            [
            'name' => 'walid',
            'password' => bcrypt('walid000'),
            'role' => 'author'
        ]);



        $categories = Category::factory(3)->create();

        $post = Post::factory()->create(['user_id' => 1]);

        // attach only one ID
        // $category->posts()->attach($post->id);

        // attach mutltiple IDs
        // $category->posts()->attach($posts->pluck('id'));

        $post->categories()->attach($categories->pluck('id'));

        // tags
        $tags = Tag::factory(5)->create();

        $post->tags()->attach($tags->pluck('id'));

        // comments
        $comments = Comment::factory(5)->create(
            [
                'user_id' => 1,
                'post_id' => $post->id,
            ]
        );
        
    }
}
