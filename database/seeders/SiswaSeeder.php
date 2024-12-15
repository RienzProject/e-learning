<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\KelasSemester;
use App\Models\DataOrangTua;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $kelasSemesterGanjil = KelasSemester::where('semester_id', 1)->get();
        $kelasSemesterGenap = KelasSemester::where('semester_id', 2)->get();

        $allKelasSemester = $kelasSemesterGanjil->merge($kelasSemesterGenap);

        $siswaPerKelas = 30;

        foreach ($allKelasSemester as $kelasSemester) {
            $kelasId = $kelasSemester->kelas_id;
            $semesterId = $kelasSemester->semester_id;

            for ($i = 0; $i < $siswaPerKelas; $i++) {
                $jenis_kelamin = $faker->randomElement(['Laki-Laki', 'Perempuan']);
                $tempat_lahir = $faker->city;
                $agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']);
                $pendidikan_sebelumnya = $faker->randomElement(['TK', 'PAUD']);
                $nama = $faker->name($jenis_kelamin == 'Laki-Laki' ? 'male' : 'female');
                $nis = $faker->unique()->numberBetween(10000, 99999);
                $nisn = $faker->unique()->numberBetween(100000, 999999);

                // Data siswa
                $siswa = Siswa::create([
                    'nama' => $nama,
                    'NIS' => $nis,
                    'NISN' => $nisn,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                    'agama' => $agama,
                    'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                    'alamat' => $faker->address,
                    'foto' => '',
                    'kelas_semester_id' => $kelasSemester->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                DataOrangTua::create([
                    'siswa_id' => $siswa->id,
                    'nama_ayah' => $faker->name,
                    'nama_ibu' => $faker->name,
                    'pekerjaan_ayah' => $faker->jobTitle,
                    'pekerjaan_ibu' => $faker->jobTitle,
                    'jalan' => $faker->streetAddress,
                    'kelurahan' => $faker->city,
                    'kecamatan' => $faker->city,
                    'kota' => $faker->city,
                    'provinsi' => $faker->state,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}

