<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'res_name' => fake()->name(), // e.g. "Premium Plan"
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->phoneNumber(), // or use 'Y-m-d' if you need formatted
            'gender' =>fake()->randomElement(['Male', 'Female']), // nullable, can also use null
            'status' =>fake()->randomElement(['active', 'inactive']),
        ];
    }
}
