<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\User;
use App\Models\WaliKelas;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class WaliKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $waliKelasUsers = [];

        for ($i = 0; $i < 6; $i++) {
            $waliKelasUsers[] = User::create([
                'name' => $faker->name,
                'NIP' => $faker->unique()->numerify('#######'),
                'username' => $faker->userName,
                'password' => Hash::make('password'),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date(),
                'alamat' => $faker->address,
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'gender' => $faker->randomElement(['Laki-Laki', 'Perempuan']),
                'role' => 'Wali Kelas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach ($waliKelasUsers as $user) {
            WaliKelas::create([
                'user_id' => $user->id,
                'kelas_id' => Kelas::inRandomOrder()->first()->id,
            ]);
        }
    }
}
