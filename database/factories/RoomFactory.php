<?php

namespace Database\Factories;

use App\Models\RoomType;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $room_type_id = RoomType::inRandomOrder()->first();
        $apartment_id = Apartment::inRandomOrder()->first();
        $rent_status = ['Available', 'Rented'];

        return [
            'room_number' => fake()->randomNumber(4, true),
            'rent_status' => $rent_status[array_rand($rent_status,1)],
            'room_type_id' => $room_type_id,
            'additional_info' => fake()->sentence(),
            'apartment_id' => $apartment_id,
        ];
    }
}
