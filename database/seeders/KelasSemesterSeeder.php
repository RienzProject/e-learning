<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\KelasSemester;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semester')->insert([
            [
                'awal_tahun_ajaran' => '2023',
                'akhir_tahun_ajaran' => '2024',
                'nama' => 'Ganjil',
                'tanggal_mulai' => '2023-01-01',
                'tanggal_akhir' => '2023-06-30',
            ],
            [
                'awal_tahun_ajaran' => '2023',
                'akhir_tahun_ajaran' => '2024',
                'nama' => 'Genap',
                'tanggal_mulai' => '2023-07-01',
                'tanggal_akhir' => '2023-12-31',
            ]
        ]);

        $kelasIds = Kelas::pluck('id')->toArray();

        $semesterGanjil = Semester::where('nama', 'Ganjil')->first()->id;
        $semesterGenap = Semester::where('nama', 'Genap')->first()->id;

        foreach ($kelasIds as $kelasId) {
           KelasSemester::create([
                'kelas_id' => $kelasId,
                'semester_id' => $semesterGanjil,
                'status' => 'Aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach ($kelasIds as $kelasId) {
            KelasSemester::create([
                'kelas_id' => $kelasId,
                'semester_id' => $semesterGenap,
                'status' => 'Non Aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
