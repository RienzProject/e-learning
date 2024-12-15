<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KepalaSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Nova Sari Padatuan',
                'NIP' => '197505261998072002',
                'username' => 'nova',
                'password' => Hash::make('novasari'),
                'tempat_lahir' => 'Kalimantan',
                'tanggal_lahir' => '1998-06-19',
                'alamat' => 'Perumahan Denpasar No. 1',
                'agama' => 'Kristen',
                'gender' => 'Perempuan',
                'role' => 'Kepala Sekolah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
