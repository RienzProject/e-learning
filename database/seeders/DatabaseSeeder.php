<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            KepalaSekolahSeeder::class,
            KelasSeeder::class,
            KelasSemesterSeeder::class,
            GuruSeeder::class,
            WaliKelasSeeder::class,
            SiswaSeeder::class,
        ]);
    }
}
