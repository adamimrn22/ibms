<?php

namespace Database\Factories;

use App\Models\UpsmRuangBooking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UpsmRuangBookingDetails>
 */
class UpsmRuangBookingDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bookingIds = UpsmRuangBooking::pluck('id')->toArray();

        return [
            'booking_id' => $this->faker->randomElement($bookingIds),
            'objective' => $this->faker->paragraph(2),
            'laptop' => $this->faker->numberBetween(0, 1),
            'lcd' => $this->faker->numberBetween(0, 1),
            'food' => $this->faker->numberBetween(0, 1),
            'food_time' => $this->faker->randomElement(['PAGI', 'TENGAH HARI', 'PETANG'])
        ];
    }
}
