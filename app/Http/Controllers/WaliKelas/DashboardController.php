<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $getCountSiswa = $this->getCountSiswa();
        $getCountHasilAkhir = $this->getCountHasilAkhir();

        // Pie chart gender
        $getCountByGender = $this->getCountByGender();
        $genderLabels = ['Laki-laki', 'Perempuan'];
        $genderData = [
            $getCountByGender['Laki-laki'],
            $getCountByGender['Perempuan']
        ];
        $genderColors = ['#4e73df', '#1cc88a'];

        return view('pages.wali-kelas.dashboard-wali-kelas', compact(
            'getCountSiswa',
            'getCountHasilAkhir',
            'genderLabels',
            'genderData',
            'genderColors'
        ));
    }


    private function getCountSiswa(){
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->pluck('kelas_id');
        $data = Siswa::whereHas('kelasSemester', function($query) use ($kelasId) {
            $query->where('status', 'Aktif');
            $query->where('kelas_id', $kelasId);
        })
        ->get();

        return $data->count();
    }

    private function getCountHasilAkhir(){
        $user = Auth::user();

        $kelasId = WaliKelas::where('user_id', $user->id)->pluck('kelas_id')->first();

        $siswaIds = Siswa::whereHas('kelasSemester', function($query) use ($kelasId) {
            $query->where('status', 'Aktif');
            $query->where('kelas_id', $kelasId);
        })
        ->pluck('id')
        ->toArray();

        $nilaiAkhirSiswa = SiswaMataPelajaran::whereIn('siswa_id', $siswaIds)->get();

        $naikKelasCount = 0;
        $tidakNaikKelasCount = 0;

        foreach ($siswaIds as $siswaId) {
            $nilaiSiswa = $nilaiAkhirSiswa->where('siswa_id', $siswaId);

            $totalNilaiAkhir = 0;
            $jumlahMataPelajaran = 0;

            foreach ($nilaiSiswa as $nilai) {
                if ($nilai->nilai_akhir !== null) {
                    $totalNilaiAkhir += $nilai->nilai_akhir;
                    $jumlahMataPelajaran++;
                }
            }

            if ($jumlahMataPelajaran > 0) {
                $rataRataNilai = $totalNilaiAkhir / $jumlahMataPelajaran;
            } else {
                $rataRataNilai = 0;
            }

            if ($rataRataNilai >= 78) {
                $naikKelasCount++;
            } else {
                $tidakNaikKelasCount++;
            }
        }

        return [
            'naik_kelas' => $naikKelasCount,
            'tidak_naik_kelas' => $tidakNaikKelasCount
        ];
    }

    private function getCountByGender() {
        $user = Auth::user();

        $kelasId = WaliKelas::where('user_id', $user->id)->pluck('kelas_id')->first();

        $data = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('status', 'Aktif')
                  ->where('kelas_id', $kelasId);
        })
        ->selectRaw('jenis_kelamin, COUNT(*) as count')
        ->groupBy('jenis_kelamin')
        ->get()
        ->pluck('count', 'jenis_kelamin');

        $countLakiLaki = $data['Laki-Laki'] ?? 0;
        $countPerempuan = $data['Perempuan'] ?? 0;

        return [
            'Laki-laki' => $countLakiLaki,
            'Perempuan' => $countPerempuan
        ];
    }
}
