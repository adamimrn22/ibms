<?php

namespace Database\Factories;

use App\Models\UpsmInventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UpsmRuangBooking>
 */
class UpsmRuangBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roomID = UpsmInventory::where('subcategory_id', 16)->pluck('id')->toArray();

        return [
            'reference' => 'BK000' . $this->faker->unique()->randomNumber(5),
            'date_book_start' => $this->faker->dateTimeBetween('-3 week', '+3 week'),
            'date_book_end' => $this->faker->dateTimeBetween('-3 week', '+3 week'),
            'time_start' => $this->faker->time,
            'time_end' => $this->faker->time,
            'room_id' => $this->faker->randomElement($roomID),
            'user_id' => 3,
            'status_id' => 2, //$this->faker->randomElement([1,2,3])
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
