<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identity_id' => 4,
            'document_number' => fake()->unique()->numerify('20#########'),
            'name' => fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            // 'phone' => fake()->phoneNumber(),
            'phone' => fake()->unique()->numerify('9########'),
        ];
    }
}
