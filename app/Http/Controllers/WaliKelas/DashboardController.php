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
    public function index(){
        $getCountSiswa = $this->getCountSiswa();
        $getCountHasilAkhir = $this->getCountHasilAkhir();

        return view('pages.wali-kelas.dashboard-wali-kelas', compact(
            'getCountSiswa',
            'getCountHasilAkhir'
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
}
