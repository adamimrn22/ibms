<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UkwInventory>
 */
class UkwInventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 100),
            'approved_quantity' => $this->faker->numberBetween(1, 50),
            'remarkNotes' => $this->faker->sentence,
            'status_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
