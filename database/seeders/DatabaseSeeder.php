<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Kristen',
            'gender' => 'Laki - Laki',
            'role' => 'Kepala Sekolah'
        ]);

        

        DB::table('kelas')->insert([
            'nama' => 'I (Satu)',
        ]);

        DB::table('kelas')->insert([
            'nama' => 'II (Dua)',
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
            'role' => 'Wali Kelas'
        ]);

        DB::table('wali_kelas')->insert([
            'user_id' => 2,
            'kelas_id' => 1,
        ]);

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
                'tanggal_akhir' => '2023-12-01',
            ]
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 1,
            'semester_id' => 1,
            'status' => 'Aktif'
        ]);

        DB::table('siswa')->insert([
            'nama' => 'Intan Tri Suaka Henry',
            'NIS' => '12345',
            'NISN' => '12345',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '2020-02-05',
            'agama' => 'Islam',
            'pendidikan_sebelumnya' => 'TK',
            'alamat' => 'Jl. Soetomo',
            'kelas_semester_id' => 1
        ]);

        DB::table('data_orang_tua')->insert([
            'siswa_id' => 1,
            'nama_ayah' => 'tes',
            'nama_ibu' => 'tes',
            'pekerjaan_ayah' => 'tes',
            'pekerjaan_ibu' => 'tes',
            'jalan' => 'tes',
            'kelurahan' => 'tes',
            'kecamatan' => 'tes',
            'kota' => 'tes',
            'provinsi' => 'tes',
        ]);

        DB::table('siswa')->insert([
            'nama' => 'Joko',
            'NIS' => '22345',
            'NISN' => '22345',
            'jenis_kelamin' => 'Laki-Laki',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '2020-02-05',
            'agama' => 'Islam',
            'pendidikan_sebelumnya' => 'TK',
            'alamat' => 'Jl. Soetomo',
            'kelas_semester_id' => 1
        ]);

        DB::table('data_orang_tua')->insert([
            'siswa_id' => 2,
            'nama_ayah' => 'tes',
            'nama_ibu' => 'tes',
            'pekerjaan_ayah' => 'tes',
            'pekerjaan_ibu' => 'tes',
            'jalan' => 'tes',
            'kelurahan' => 'tes',
            'kecamatan' => 'tes',
            'kota' => 'tes',
            'provinsi' => 'tes',
        ]);

        DB::table('mata_pelajaran')->insert([
            'kelas_id' => 1,
            'user_id' => 2,
            'kode' => 'ABC123',
            'jenis' => 'Mata Pelajaran',
            'nama' => 'Matematika'
        ]);

        DB::table('siswa_mata_pelajaran')->insert([
            'siswa_id' => 2,
            'mata_pelajaran_id' => 1,
            'nilai_akhir' => null
        ]);

        DB::table('siswa_mata_pelajaran')->insert([
            'siswa_id' => 1,
            'mata_pelajaran_id' => 1,
            'nilai_akhir' => null
        ]);

        DB::table('mata_pelajaran')->insert([
            'kelas_id' => 1,
            'user_id' => 2,
            'kode' => 'ABC123',
            'jenis' => 'Mata Pelajaran',
            'nama' => 'Bahasa Indonesia'
        ]);

        DB::table('siswa_mata_pelajaran')->insert([
            'siswa_id' => 1,
            'mata_pelajaran_id' => 2,
            'nilai_akhir' => null
        ]);

        DB::table('siswa_mata_pelajaran')->insert([
            'siswa_id' => 2,
            'mata_pelajaran_id' => 2,
            'nilai_akhir' => null
        ]);

        DB::table('mata_pelajaran')->insert([
            'kelas_id' => 1,
            'user_id' => 2,
            'kode' => 'ABC123',
            'jenis' => 'Mata Pelajaran',
            'nama' => 'Bahasa Inggris'
        ]);

        DB::table('siswa_mata_pelajaran')->insert([
            'siswa_id' => 1,
            'mata_pelajaran_id' => 3,
            'nilai_akhir' => null
        ]);

        DB::table('siswa_mata_pelajaran')->insert([
            'siswa_id' => 2,
            'mata_pelajaran_id' => 3,
            'nilai_akhir' => null
        ]);
    }
}
