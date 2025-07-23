<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'identity_id' => 4,
            'document_number' => fake()->unique()->numerify('20#########'),
            'name' => fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'phone' => fake()->unique()->numerify('9########'),
        ];
    }
}
