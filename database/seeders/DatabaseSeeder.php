<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Program;
use App\Models\University;
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



        $category = Category::factory()->create();

        $posts = Post::factory(3)->create(['user_id' => 1]);

        // attach only one ID
        // $category->posts()->attach($post->id);

        // attach mutltiple IDs
        $category->posts()->attach($posts->pluck('id'));

        // tags
        $tags = Tag::factory(5)->create();

        

        $posts->each(fn($post) => $post->tags()->attach($tags->pluck('id')));

        $posts->each(fn($post) => 
            Comment::factory(5)->create(
            [
                'user_id' => 1,
                'post_id' => $post->id,
            ]
        ));

        Country::factory(3)->create();
        
        $country = Country::firstOrCreate([
            'name' => 'England',
            'iso_code' => 'EN',
            'slug' => 'england'
        ]);

        $universities = University::factory(3)->create([
            'country_id' => $country->id,
        ]);

        $universities->each(fn($uni) => 
            Program::factory(3)->create([
                'university_id' => $uni->id,
            ])
        );
    }
}
