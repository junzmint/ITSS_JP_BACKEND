<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RoomMedia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CreateApartmentType::class,
            CreateRoomType::class,
        ]);

        \App\Models\User::factory()->create();

        $room_media_url = [
            'https://www.thespruce.com/thmb/9lEUgCeIJwiY-7PfZrL3AO7tWCY=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/EleanorEmail-5aaf1c6ec5cf45eea0a4cd70ddbd4b21.png',
            'https://www.thespruce.com/thmb/h14GBjBDC4lSx26Ncpa7ahwWxtc=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/AgnesArtandPhotoforMackenzieCollierInteriors.jpg-096098e38406478894a7ec9f40fbdfc4.jpg',
            'https://www.thespruce.com/thmb/8UU1FaU16IeUimv4VLjr3mrJIRs=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/MaryPattonDesignlRiverOaksResidencelCreditslMollyCulver-a1d6f86382674828b9e9fa28e4aa47b2.jpg',
            'https://www.thespruce.com/thmb/2_Q52GK3rayV1wnqm6vyBvgI3Ew=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/put-together-a-perfect-guest-room-1976987-hero-223e3e8f697e4b13b62ad4fe898d492d.jpg',
            'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cm9vbXxlbnwwfHwwfHx8MA%3D%3D',
            'https://images.pexels.com/photos/1571458/pexels-photo-1571458.jpeg?cs=srgb&dl=pexels-vecislavas-popa-1571458.jpg&fm=jpg',
            'https://images.pexels.com/photos/7512042/pexels-photo-7512042.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
            'https://images.pexels.com/photos/8089271/pexels-photo-8089271.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        ];
        $gender = ['Male', 'Other', 'Female'];
        $bool = [true, false];
        $rent_type = ['Rented', 'Owned'];

        for ($x = 0; $x < 5; $x++) {
            $apartment = \App\Models\Apartment::factory()->create();

            \App\Models\Room::factory(10)->create();

            $room_ids = \App\Models\Room::where('apartment_id', $apartment->id)->pluck('id');

            foreach ($room_ids as $room_id) {
                RoomMedia::create([
                    'room_id' => $room_id,
                    'url' => $room_media_url[array_rand($room_media_url)],
                ]);
                RoomMedia::create([
                    'room_id' => $room_id,
                    'url' => $room_media_url[array_rand($room_media_url)],
                ]);

                for ($y = 0; $y < 5; $y++) {
                    $deadline = fake()->dateTimeBetween('-3 month', '+3 month');
                    $water = fake()->randomNumber(4, true);
                    $service = fake()->randomNumber(4, true);
                    $rent = fake()->randomNumber(4, true);
                    $electricity = fake()->randomNumber(4, true);
                    $total = $water + $service + $rent + $electricity;
                    $payment_method = fake()->creditCardType();

                    \App\Models\Payment::create([
                        'room_id' => $room_id,
                        'deadline' => $deadline,
                        'water' => $water,
                        'service' => $service,
                        'rent' => $rent,
                        'total' => $total,
                        'electricity' => $electricity,
                        'payment_method' => $payment_method,
                    ]);

                    $deadline = fake()->dateTimeBetween('-3 month', '+3 month');
                    $pay_at = fake()->dateTimeBetween('3 month', '4 month');
                    $water = fake()->randomNumber(4, true);
                    $service = fake()->randomNumber(4, true);
                    $rent = fake()->randomNumber(4, true);
                    $electricity = fake()->randomNumber(4, true);
                    $total = $water + $service + $rent + $electricity;
                    $payment_method = fake()->creditCardType();

                    \App\Models\Payment::create([
                        'room_id' => $room_id,
                        'deadline' => $deadline,
                        'water' => $water,
                        'service' => $service,
                        'rent' => $rent,
                        'total' => $total,
                        'electricity' => $electricity,
                        'payment_method' => $payment_method,
                        'pay_at' => $pay_at,
                    ]);
                }

                for ($z = 0; $z <= 5; $z++) {
                    $user = \App\Models\Tenant::create([
                        'name' => fake()->name(),
                        'phone_number' => fake()->unique()->phoneNumber(),
                        'citizen_number' => fake()->unique()->uuid(),
                        'gender' => $gender[array_rand($gender)],
                        'email' => fake()->unique()->safeEmail(),
                    ]);
                    if ($z == 0) {
                        $room_host = true;
                    } else {
                        $room_host = false;
                    }
                    if ($z < 5) {
                        $time = fake()->dateTimeBetween('-24 month', '-3 month');

                        $user->rooms()->attach($room_id, [
                            'room_host' => $room_host,
                            'rent_type' => $rent_type[array_rand($rent_type)],
                            'living_status' => $bool[array_rand($bool)],
                            'created_at' => $time,
                        ]);
                    } else {
                        $created_at = fake()->dateTimeBetween('-24 month', '-3 month');
                        $deleted_at = fake()->dateTimeBetween('+3 month', '+24 month');
                        $user->rooms()->attach($room_id, [
                            'room_host' => $room_host,
                            'rent_type' => $rent_type[array_rand($rent_type)],
                            'living_status' => $bool[array_rand($bool)],
                            'created_at' => $created_at,
                            'deleted_at' => $deleted_at,
                        ]);
                    }
                }
            }
        }
    }
}
