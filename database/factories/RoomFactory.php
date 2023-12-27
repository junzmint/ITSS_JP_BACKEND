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
        $room_type_id = RoomType::inRandomOrder()->first()->id;
        $apartment_id = Apartment::orderBy('id', 'desc')->first()->id;

        return [
            'room_number' => fake()->randomNumber(4, true),
            'rent_status' => 'Rented',
            'room_type_id' => $room_type_id,
            'additional_info' => fake()->sentence(),
            'apartment_id' => $apartment_id,
        ];
    }
}
