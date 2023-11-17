<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\ApartmentType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::first();
        $apartment_type_id = ApartmentType::first();
        return [
            'name' => fake()->name(),
            'address' => fake()->address(),
            'user_id' => $user_id,
            'apartment_type_id' => $apartment_type_id,
            'overall_status' => fake()->text(),
        ];
    }
}
