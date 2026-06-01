<?php

namespace Database\Factories;

use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<University>
 */
class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'city' => fake()->city(),
            'about' => fake()->paragraph(),
            'accommodation' => fake()->paragraph(2),
            'finance' => fake()->paragraph(4),
            'scholarships' => fake()->paragraph(),
            'research' => fake()->text(),
            'pathway' => fake()->text(250),
        ];
    }
}
