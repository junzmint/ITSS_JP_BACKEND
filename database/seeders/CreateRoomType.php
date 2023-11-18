<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateRoomType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::create([
            'description' => 'D là dining (phòng ăn) và K là kitchen (nhà bếp)',
            'default_rent_price' => '100000',
            'type' => '1DK',
        ]);

        RoomType::create([
            'description' => 'L là Living (phòng khách). LDK là “Living, Dining & Kitchen”',
            'default_rent_price' => '120000',
            'type' => '1LDK',
        ]);

        RoomType::create([
            'description' => '3 phòng ngủ ,phòng khách , bếp và phòng ăn”',
            'default_rent_price' => '200000',
            'type' => '3LDK',
        ]);
    }
}
