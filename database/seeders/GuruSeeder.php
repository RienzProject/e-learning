<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

// class GuruSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         $faker = Faker::create('id_ID');
//         $guruKelasUsers = [];

//         for ($i = 0; $i < 2; $i++) {
//             $guruKelasUsers[] = User::create([
//                 'name' => $faker->name,
//                 'NIP' => $faker->unique()->numerify('#######'),
//                 'username' => $faker->userName,
//                 'password' => Hash::make('password'),
//                 'tempat_lahir' => $faker->city,
//                 'tanggal_lahir' => $faker->date(),
//                 'alamat' => $faker->address,
//                 'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
//                 'gender' => $faker->randomElement(['Laki-Laki', 'Perempuan']),
//                 'role' => 'Guru',
//                 'created_at' => Carbon::now(),
//                 'updated_at' => Carbon::now(),
//             ]);
//         }
//     }
// }
