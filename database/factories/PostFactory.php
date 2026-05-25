<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = fake()->sentence(6);

        return [
        'title' => $title,
        'slug' => Str::slug($title),

        'excerpt' => fake()->text(120),

        'content' => fake()->paragraphs(5, true),

        'featured_image' => fake()->imageUrl(640, 480, 'business', true),

    ];
    }
}
