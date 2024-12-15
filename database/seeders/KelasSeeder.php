<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataKelas = [
            'I (Satu)',
            'II (Dua)',
            'III (Tiga)',
            'IV (Empat)',
            'V (Lima)',
            'VI (Enam)',
        ];

        foreach ($dataKelas as $nama) {
            Kelas::create([
                'nama' => $nama,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
