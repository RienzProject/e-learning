<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\Siswa;
use App\Models\DataOrangTua;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call([
        //     UserSeeder::class
        // ]);

        DB::table('users')->insert([
            'name' => 'Nova Sari Padatuan',
            'NIP' => '197505261998072002',
            'username' => 'nova',
            'password' => Hash::make('novasari'),
            'tempat_lahir' => 'Kalimantan',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Kristen',
            'gender' => 'Perempuan',
            'role' => 'Kepala Sekolah'
        ]);



        DB::table('kelas')->insert([
            'nama' => 'I (Satu)',
        ]);

        DB::table('kelas')->insert([
            'nama' => 'II (Dua)',
        ]);

        DB::table('kelas')->insert([
            'nama' => 'III (Tiga)',
        ]);

        DB::table('kelas')->insert([
            'nama' => 'IV (Empat)',
        ]);

        DB::table('kelas')->insert([
            'nama' => 'V (Lima)',
        ]);

        DB::table('kelas')->insert([
            'nama' => 'VI (Enam)',
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'NIP' => '198205172008012015',
            'username' => 'budisetyo',
            'password' => Hash::make('password'),
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Islam',
            'gender' => 'Laki - Laki',
            'foto' => '',
            'role' => 'Wali Kelas'
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'NIP' => '198205172008012015',
            'username' => 'kelas2',
            'password' => Hash::make('kelas2'),
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Islam',
            'gender' => 'Laki - Laki',
            'foto' => '',
            'role' => 'Wali Kelas'
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'NIP' => '198205172008012015',
            'username' => 'kelas3',
            'password' => Hash::make('kelas3'),
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Islam',
            'gender' => 'Laki - Laki',
            'foto' => '',
            'role' => 'Wali Kelas'
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'NIP' => '198205172008012015',
            'username' => 'kelas4',
            'password' => Hash::make('kelas4'),
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Islam',
            'gender' => 'Laki - Laki',
            'foto' => '',
            'role' => 'Wali Kelas'
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'NIP' => '198205172008012015',
            'username' => 'kelas5',
            'password' => Hash::make('kelas5'),
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Islam',
            'gender' => 'Laki - Laki',
            'foto' => '',
            'role' => 'Wali Kelas'
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'NIP' => '198205172008012015',
            'username' => 'kelas6',
            'password' => Hash::make('kelas6'),
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Islam',
            'gender' => 'Laki - Laki',
            'foto' => '',
            'role' => 'Wali Kelas'
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'NIP' => '198205172008012015',
            'username' => 'guru1',
            'password' => Hash::make('guru1'),
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Islam',
            'gender' => 'Laki - Laki',
            'foto' => '',
            'role' => 'Guru'
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'NIP' => '198205172008012015',
            'username' => 'guru2',
            'password' => Hash::make('guru2'),
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Islam',
            'gender' => 'Laki - Laki',
            'foto' => '',
            'role' => 'Guru'
        ]);

        DB::table('wali_kelas')->insert([
            'user_id' => 2,
            'kelas_id' => 1,
        ]);

        DB::table('wali_kelas')->insert([
            'user_id' => 3,
            'kelas_id' => 2,
        ]);

        DB::table('wali_kelas')->insert([
            'user_id' => 4,
            'kelas_id' => 3,
        ]);

        DB::table('wali_kelas')->insert([
            'user_id' => 5,
            'kelas_id' => 4,
        ]);

        DB::table('wali_kelas')->insert([
            'user_id' => 6,
            'kelas_id' => 5,
        ]);

        DB::table('wali_kelas')->insert([
            'user_id' => 7,
            'kelas_id' => 6,
        ]);

        DB::table('guru_kelas')->insert([
            'user_id' => 8,
            'kelas_id' => 1,
        ]);

        DB::table('guru_kelas')->insert([
            'user_id' => 8,
            'kelas_id' => 2,
        ]);

        DB::table('guru_kelas')->insert([
            'user_id' => 8,
            'kelas_id' => 3,
        ]);

        DB::table('guru_kelas')->insert([
            'user_id' => 8,
            'kelas_id' => 4,
        ]);

        DB::table('guru_kelas')->insert([
            'user_id' => 8,
            'kelas_id' => 5,
        ]);

        DB::table('guru_kelas')->insert([
            'user_id' => 8,
            'kelas_id' => 6,
        ]);

        DB::table('semester')->insert([
            [
                'awal_tahun_ajaran' => '2023',
                'akhir_tahun_ajaran' => '2024',
                'nama' => 'Ganjil',
                'tanggal_mulai' => '2023-01-01',
                'tanggal_akhir' => '2023-06-30',
            ],
        ]);

        DB::table('semester')->insert([
            [
                'awal_tahun_ajaran' => '2023',
                'akhir_tahun_ajaran' => '2024',
                'nama' => 'genap',
                'tanggal_mulai' => '2023-01-01',
                'tanggal_akhir' => '2023-06-30',
            ],
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 1,
            'semester_id' => 1,
            'status' => 'Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 2,
            'semester_id' => 1,
            'status' => 'Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 3,
            'semester_id' => 1,
            'status' => 'Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 4,
            'semester_id' => 1,
            'status' => 'Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 5,
            'semester_id' => 1,
            'status' => 'Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 6,
            'semester_id' => 1,
            'status' => 'Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 1,
            'semester_id' => 2,
            'status' => 'Non Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 2,
            'semester_id' => 2,
            'status' => 'Non Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 3,
            'semester_id' => 2,
            'status' => 'Non Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 4,
            'semester_id' => 2,
            'status' => 'Non Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 5,
            'semester_id' => 2,
            'status' => 'Non Aktif'
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 6,
            'semester_id' => 2,
            'status' => 'Non Aktif'
        ]);

        $faker = Faker::create('id_ID'); // Locale Indonesia

        foreach (range(1, 20) as $index) { // Generate 50 data dummy
            // Nilai default atau template statis
            $jenis_kelamin = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $tempat_lahir = $faker->city;
            $agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']);
            $pendidikan_sebelumnya = $faker->randomElement(['TK', 'PAUD']);
            $nama = $faker->name($jenis_kelamin == 'Laki-Laki' ? 'male' : 'female'); // Nama siswa tetap sama

            // Generate NIS dan NISN yang sama untuk semester ganjil dan genap
            $nis = $faker->unique()->numberBetween(10000, 99999);
            $nisn = $faker->unique()->numberBetween(100000, 999999);

            // Data untuk semester ganjil
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,
                'NISN' => $nisn,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 1, // Semester ganjil
            ]);

            // Data untuk semester genap dengan NIS dan NISN yang sama
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,  // Pastikan NIS yang sama
                'NISN' => $nisn, // Pastikan NISN yang sama
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 7, // Semester genap
            ]);
        }

        $faker = Faker::create('id_ID'); // Locale Indonesia

        foreach (range(1, 20) as $index) { // Generate 50 data dummy
            // Nilai default atau template statis
            $jenis_kelamin = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $tempat_lahir = $faker->city;
            $agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']);
            $pendidikan_sebelumnya = $faker->randomElement(['TK', 'PAUD']);
            $nama = $faker->name($jenis_kelamin == 'Laki-Laki' ? 'male' : 'female'); // Nama siswa tetap sama

            // Generate NIS dan NISN yang sama untuk semester ganjil dan genap
            $nis = $faker->unique()->numberBetween(10000, 99999);
            $nisn = $faker->unique()->numberBetween(100000, 999999);

            // Data untuk semester ganjil
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,
                'NISN' => $nisn,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 2, // Semester ganjil
            ]);

            // Data untuk semester genap dengan NIS dan NISN yang sama
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,  // Pastikan NIS yang sama
                'NISN' => $nisn, // Pastikan NISN yang sama
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 8, // Semester genap
            ]);
        }

        $faker = Faker::create('id_ID'); // Locale Indonesia

        foreach (range(1, 20) as $index) { // Generate 50 data dummy
            // Nilai default atau template statis
            $jenis_kelamin = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $tempat_lahir = $faker->city;
            $agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']);
            $pendidikan_sebelumnya = $faker->randomElement(['TK', 'PAUD']);
            $nama = $faker->name($jenis_kelamin == 'Laki-Laki' ? 'male' : 'female'); // Nama siswa tetap sama

            // Generate NIS dan NISN yang sama untuk semester ganjil dan genap
            $nis = $faker->unique()->numberBetween(10000, 99999);
            $nisn = $faker->unique()->numberBetween(100000, 999999);

            // Data untuk semester ganjil
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,
                'NISN' => $nisn,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 3, // Semester ganjil
            ]);

            // Data untuk semester genap dengan NIS dan NISN yang sama
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,  // Pastikan NIS yang sama
                'NISN' => $nisn, // Pastikan NISN yang sama
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 9, // Semester genap
            ]);
        }

        $faker = Faker::create('id_ID'); // Locale Indonesia

        foreach (range(1, 20) as $index) { // Generate 50 data dummy
            // Nilai default atau template statis
            $jenis_kelamin = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $tempat_lahir = $faker->city;
            $agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']);
            $pendidikan_sebelumnya = $faker->randomElement(['TK', 'PAUD']);
            $nama = $faker->name($jenis_kelamin == 'Laki-Laki' ? 'male' : 'female'); // Nama siswa tetap sama

            // Generate NIS dan NISN yang sama untuk semester ganjil dan genap
            $nis = $faker->unique()->numberBetween(10000, 99999);
            $nisn = $faker->unique()->numberBetween(100000, 999999);

            // Data untuk semester ganjil
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,
                'NISN' => $nisn,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 4, // Semester ganjil
            ]);

            // Data untuk semester genap dengan NIS dan NISN yang sama
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,  // Pastikan NIS yang sama
                'NISN' => $nisn, // Pastikan NISN yang sama
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 10, // Semester genap
            ]);
        }

        $faker = Faker::create('id_ID'); // Locale Indonesia

        foreach (range(1, 20) as $index) { // Generate 50 data dummy
            // Nilai default atau template statis
            $jenis_kelamin = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $tempat_lahir = $faker->city;
            $agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']);
            $pendidikan_sebelumnya = $faker->randomElement(['TK', 'PAUD']);
            $nama = $faker->name($jenis_kelamin == 'Laki-Laki' ? 'male' : 'female'); // Nama siswa tetap sama

            // Generate NIS dan NISN yang sama untuk semester ganjil dan genap
            $nis = $faker->unique()->numberBetween(10000, 99999);
            $nisn = $faker->unique()->numberBetween(100000, 999999);

            // Data untuk semester ganjil
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,
                'NISN' => $nisn,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 5, // Semester ganjil
            ]);

            // Data untuk semester genap dengan NIS dan NISN yang sama
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,  // Pastikan NIS yang sama
                'NISN' => $nisn, // Pastikan NISN yang sama
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 11, // Semester genap
            ]);
        }

        $faker = Faker::create('id_ID'); // Locale Indonesia

        foreach (range(1, 20) as $index) { // Generate 50 data dummy
            // Nilai default atau template statis
            $jenis_kelamin = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $tempat_lahir = $faker->city;
            $agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']);
            $pendidikan_sebelumnya = $faker->randomElement(['TK', 'PAUD']);
            $nama = $faker->name($jenis_kelamin == 'Laki-Laki' ? 'male' : 'female'); // Nama siswa tetap sama

            // Generate NIS dan NISN yang sama untuk semester ganjil dan genap
            $nis = $faker->unique()->numberBetween(10000, 99999);
            $nisn = $faker->unique()->numberBetween(100000, 999999);

            // Data untuk semester ganjil
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,
                'NISN' => $nisn,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 6, // Semester ganjil
            ]);

            // Data untuk semester genap dengan NIS dan NISN yang sama
            DB::table('siswa')->insert([
                'nama' => $nama,
                'NIS' => $nis,  // Pastikan NIS yang sama
                'NISN' => $nisn, // Pastikan NISN yang sama
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $faker->date('Y-m-d', '2015-12-31'),
                'agama' => $agama,
                'pendidikan_sebelumnya' => $pendidikan_sebelumnya,
                'alamat' => $faker->address,
                'foto' => '', // Foto dapat dikosongkan atau diisi sesuai kebutuhan
                'kelas_semester_id' => 12, // Semester genap
            ]);
        }

        //Faker orang tua
        $faker = Faker::create('id_ID');

        // Ambil semua siswa
        $siswa = Siswa::all();

        // Loop untuk setiap siswa
        foreach ($siswa as $s) {
            DB::table('data_orang_tua')->insert([
                'siswa_id' => $s->id,  // Menggunakan ID siswa
                'nama_ayah' => $faker->name,  // Nama Ayah acak
                'nama_ibu' => $faker->name,  // Nama Ibu acak
                'pekerjaan_ayah' => $faker->jobTitle,  // Pekerjaan Ayah acak
                'pekerjaan_ibu' => $faker->jobTitle,  // Pekerjaan Ibu acak
                'jalan' => $faker->streetAddress,  // Alamat Jalan acak
                'kelurahan' => $faker->city,  // Kelurahan acak
                'kecamatan' => $faker->city,  // Kecamatan acak
                'kota' => $faker->city,  // Kota acak
                'provinsi' => $faker->state,  // Provinsi acak
            ]);
        }

        DB::table('ekstrakulikuler')->insert([
            'nama' => 'Pramuka',
            'hari' => 'Senin',
            'jam' => '22:12',
        ]);

        // DB::table('siswa')->insert([
        //     'nama' => 'Joko',
        //     'NIS' => '22345',
        //     'NISN' => '22345',
        //     'jenis_kelamin' => 'Laki-Laki',
        //     'tempat_lahir' => 'Denpasar',
        //     'tanggal_lahir' => '2020-02-05',
        //     'agama' => 'Islam',
        //     'pendidikan_sebelumnya' => 'TK',
        //     'alamat' => 'Jl. Soetomo',
        //     'kelas_semester_id' => 1
        // ]);

        // DB::table('data_orang_tua')->insert([
        //     'siswa_id' => 2,
        //     'nama_ayah' => 'tes',
        //     'nama_ibu' => 'tes',
        //     'pekerjaan_ayah' => 'tes',
        //     'pekerjaan_ibu' => 'tes',
        //     'jalan' => 'tes',
        //     'kelurahan' => 'tes',
        //     'kecamatan' => 'tes',
        //     'kota' => 'tes',
        //     'provinsi' => 'tes',
        // ]);

        // DB::table('mata_pelajaran')->insert([
        //     'kelas_id' => 1,
        //     'user_id' => 2,
        //     'kode' => 'ABC123',
        //     'jenis' => 'Mata Pelajaran',
        //     'nama' => 'Matematika'
        // ]);

        // DB::table('siswa_mata_pelajaran')->insert([
        //     'siswa_id' => 2,
        //     'mata_pelajaran_id' => 1,
        //     'nilai_akhir' => null
        // ]);

        // DB::table('siswa_mata_pelajaran')->insert([
        //     'siswa_id' => 1,
        //     'mata_pelajaran_id' => 1,
        //     'nilai_akhir' => null
        // ]);

        // DB::table('mata_pelajaran')->insert([
        //     'kelas_id' => 1,
        //     'user_id' => 2,
        //     'kode' => 'ABC123',
        //     'jenis' => 'Mata Pelajaran',
        //     'nama' => 'Bahasa Indonesia'
        // ]);

        // DB::table('siswa_mata_pelajaran')->insert([
        //     'siswa_id' => 1,
        //     'mata_pelajaran_id' => 2,
        //     'nilai_akhir' => null
        // ]);

        // DB::table('siswa_mata_pelajaran')->insert([
        //     'siswa_id' => 2,
        //     'mata_pelajaran_id' => 2,
        //     'nilai_akhir' => null
        // ]);

        // DB::table('mata_pelajaran')->insert([
        //     'kelas_id' => 1,
        //     'user_id' => 2,
        //     'kode' => 'ABC123',
        //     'jenis' => 'Mata Pelajaran',
        //     'nama' => 'Bahasa Inggris'
        // ]);

        // DB::table('siswa_mata_pelajaran')->insert([
        //     'siswa_id' => 1,
        //     'mata_pelajaran_id' => 3,
        //     'nilai_akhir' => null
        // ]);

        // DB::table('siswa_mata_pelajaran')->insert([
        //     'siswa_id' => 2,
        //     'mata_pelajaran_id' => 3,
        //     'nilai_akhir' => null
        // ]);
    }
}
