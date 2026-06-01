<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->word();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'degree_level' => fake()->sentence(2),
            'duration' => '5 days',
            'tuition' => fake()->numberBetween(100, 5000),
            'description' => fake()->text(),
        ];
    }
}
