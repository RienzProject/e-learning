<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\KelasSemester;
use App\Models\DataOrangTua;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

// class SiswaSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         $faker = Faker::create('id_ID');
//         $kelasSemesterGanjil = KelasSemester::where('semester_id', 1)->get();
//         $kelasSemesterGenap = KelasSemester::where('semester_id', 2)->get();

//         $siswaPerKelas = 20;

//         // Cache siswa agar nama dan data tetap sama di ganjil dan genap
//         $siswaCache = [];

//         foreach ($kelasSemesterGanjil as $kelasSemester) {
//             for ($i = 0; $i < $siswaPerKelas; $i++) {
//                 $jenis_kelamin = $faker->randomElement(['Laki-Laki', 'Perempuan']);
//                 $tempat_lahir = $faker->city;
//                 $agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']);
//                 $pendidikan_sebelumnya = $faker->randomElement(['TK', 'PAUD']);
                
//                 // Menggunakan nama lengkap Indonesia (tanpa gelar)
//                 $fullName = $faker->name($jenis_kelamin == 'Laki-Laki' ? 'male' : 'female');
                
//                 // Pastikan nama terdiri dari dua kata, jika hanya satu kata maka tambahkan nama belakang
//                 $nama = preg_replace('/\s[^ ]*$/', '', $fullName);  // Menghapus gelar jika ada

//                 // Membuat nama dua kata, jika hanya satu kata
//                 if (str_word_count($nama) < 2) {
//                     $nama .= ' ' . $faker->lastName;  // Menambahkan nama belakang jika hanya satu kata
//                 }

//                 $nis = $faker->unique()->numberBetween(10000, 99999);
//                 $nisn = $faker->unique()->numberBetween(100000, 999999);

//                 // Buat siswa baru
//                 $siswa = Siswa::create([
//                     'nama' => $nama,
//                     'NIS' => $nis,
//                     'NISN' => $nisn,
//                     'jenis_kelamin' => $jenis_kelamin,
//                     'tempat_lahir' => $tempat_lahir,
//                     'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
//                     'agama' => $agama,
//                     'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
//                     'alamat' => $faker->address,
//                     'foto' => 'https://picsum.photos/seed/' . $faker->unique()->word . '/200/200', // Foto random
//                     'kelas_semester_id' => $kelasSemester->id,
//                     'created_at' => Carbon::now(),
//                     'updated_at' => Carbon::now(),
//                 ]);

//                 // Simpan siswa ke cache
//                 $siswaCache[$kelasSemester->kelas_id][$i] = [
//                     'siswa' => $siswa,
//                     'dataOrangTua' => DataOrangTua::create([
//                         'siswa_id' => $siswa->id,
//                         'nama_ayah' => $faker->name,
//                         'nama_ibu' => $faker->name,
//                         'pekerjaan_ayah' => $faker->jobTitle,
//                         'pekerjaan_ibu' => $faker->jobTitle,
//                         'jalan' => $faker->streetAddress,
//                         'kelurahan' => $faker->city,
//                         'kecamatan' => $faker->city,
//                         'kota' => $faker->city,
//                         'provinsi' => $faker->state,
//                         'created_at' => Carbon::now(),
//                         'updated_at' => Carbon::now(),
//                     ]),
//                 ];
//             }
//         }        

//         // Assign siswa yang sama ke semester genap
//         foreach ($kelasSemesterGenap as $kelasSemester) {
//             $kelasId = $kelasSemester->kelas_id;

//             if (isset($siswaCache[$kelasId])) {
//                 foreach ($siswaCache[$kelasId] as $data) {
//                     // Replikasi siswa
//                     $siswaGenap = Siswa::create([
//                         'nama' => $data['siswa']->nama,
//                         'NIS' => $data['siswa']->NIS,
//                         'NISN' => $data['siswa']->NISN,
//                         'jenis_kelamin' => $data['siswa']->jenis_kelamin,
//                         'tempat_lahir' => $data['siswa']->tempat_lahir,
//                         'tanggal_lahir' => $data['siswa']->tanggal_lahir,
//                         'agama' => $data['siswa']->agama,
//                         'pendidikan_sebelumnya' => $data['siswa']->pendidikan_sebelumnya,
//                         'alamat' => $data['siswa']->alamat,
//                         'foto' => $data['siswa']->foto,
//                         'kelas_semester_id' => $kelasSemester->id,
//                         'created_at' => Carbon::now(),
//                         'updated_at' => Carbon::now(),
//                     ]);

//                     // Replikasi data orang tua
//                     DataOrangTua::create([
//                         'siswa_id' => $siswaGenap->id,
//                         'nama_ayah' => $data['dataOrangTua']->nama_ayah,
//                         'nama_ibu' => $data['dataOrangTua']->nama_ibu,
//                         'pekerjaan_ayah' => $data['dataOrangTua']->pekerjaan_ayah,
//                         'pekerjaan_ibu' => $data['dataOrangTua']->pekerjaan_ibu,
//                         'jalan' => $data['dataOrangTua']->jalan,
//                         'kelurahan' => $data['dataOrangTua']->kelurahan,
//                         'kecamatan' => $data['dataOrangTua']->kecamatan,
//                         'kota' => $data['dataOrangTua']->kota,
//                         'provinsi' => $data['dataOrangTua']->provinsi,
//                         'created_at' => Carbon::now(),
//                         'updated_at' => Carbon::now(),
//                     ]);
//                 }
//             }
//         }
//     }
// }
