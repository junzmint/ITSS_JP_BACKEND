<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $room_id = Room::inRandomOrder()->first();
        $deadline = fake()->dateTimeBetween('-3 month', '+3 month');
        $pay_at = fake()->dateTimeBetween('-3 month', '+3 month');
        $water = fake()->randomNumber(4, true);
        $service = fake()->randomNumber(4, true);
        $rent = fake()->randomNumber(4, true);
        $electricity = fake()->randomNumber(4, true);
        $total = $water + $service + $rent + $electricity;
        $payment_method = fake()->creditCardType();

        return [
            'room_id' => $room_id,
            'deadline' => $deadline,
            'pay_at' => $pay_at,
            'water' => $water,
            'service' => $service,
            'rent' => $rent,
            'total' => $total,
            'electricity' => $electricity,
            'payment_method' => $payment_method,
        ];
    }
}
