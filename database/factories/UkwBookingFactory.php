<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BookingStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UkwBooking>
 */
class UkwBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => $this->faker->unique()->word,
            'user_id' => User::factory(),
            'status_id' => 2,
            'remark' => $this->faker->text,
        ];
    }
}
