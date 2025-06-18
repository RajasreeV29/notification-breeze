<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'package_name' => fake()->words(2, true), // e.g. "Premium Plan"
            'credits' => fake()->numberBetween(10, 1000),
            'credit_due' => fake()->date(), // or use 'Y-m-d' if you need formatted
            'status' =>fake()->randomElement(['active', 'inactive', 'pending']), // nullable, can also use null
        ];
    }
}
