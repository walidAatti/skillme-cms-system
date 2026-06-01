<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country = fake()->unique()->country();
        return [
            'name' => $country,
            'slug' => Str::slug($country),
            'iso_code' => fake()->countryCode(),
        ];
    }
}
