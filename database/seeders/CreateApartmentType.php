<?php

namespace Database\Seeders;

use App\Models\ApartmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateApartmentType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApartmentType::create([
            'type' => 'normal',
            'description' => 'This is a normal apartment description.'
        ]);

        ApartmentType::create([
            'type' => 'high-class',
            'description' => 'This is a high-class apartment description.'
        ]);
    }
}
