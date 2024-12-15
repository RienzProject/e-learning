<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\KelasSemester;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $getCountSiswa = $this->getCountSiswa();
        $getCountHasilAkhir = $this->getCountHasilAkhir();
        $getCountTenagaPengajar = $this->getCountTenagaPengajar();
        $getCountSiswaPerKelas = $this->getCountSiswaPerKelas();
        $getCountSiswaStatusPerKelas = $this->getCountSiswaStatusPerKelas();

        return view('pages.kepala-sekolah.dashboard-kepala-sekolah', compact(
            'getCountSiswa',
            'getCountHasilAkhir',
            'getCountTenagaPengajar',
            'getCountSiswaPerKelas',
            'getCountSiswaStatusPerKelas'
        ));
    }

    private function getCountSiswa(){
        $data = Siswa::whereHas('kelasSemester', function($query) {
            $query->where('status', 'Aktif');
        })
        ->get();

        return $data->count();
    }

    private function getCountHasilAkhir(){
        $siswaIds = Siswa::whereHas('kelasSemester', function($query) {
            $query->where('status', 'Aktif');
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

    private function getCountTenagaPengajar(){
        $tenagaPengajar = User::where('role', '!=', 'Kepala Sekolah')->count();
        return $tenagaPengajar;
    }

    private function getCountSiswaPerKelas()
    {
        $jumlahSiswaPerKelas = Siswa::select('kelas.id as kelas_id', 'kelas.nama as nama_kelas', DB::raw('count(*) as total_siswa'))
            ->join('kelas_semester', 'kelas_semester.id', '=', 'siswa.kelas_semester_id')
            ->join('kelas', 'kelas.id', '=', 'kelas_semester.kelas_id')
            ->where('kelas_semester.status', 'Aktif')
            ->groupBy('kelas.id', 'kelas.nama')
            ->get();

        $kelasData = [];
        $jumlahSiswa = [];
        $warnaBar = [];

        $warnaKelas = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)'
        ];

        foreach ($jumlahSiswaPerKelas as $index => $kelas) {
            $kelasData[] = $kelas->nama_kelas;
            $jumlahSiswa[] = $kelas->total_siswa;
            $warnaBar[] = $warnaKelas[$index % count($warnaKelas)];
        }

        return [
            'kelasData' => $kelasData,
            'jumlahSiswa' => $jumlahSiswa,
            'warnaBar' => $warnaBar
        ];
    }

    private function getCountSiswaStatusPerKelas()
    {
        $kelasSemesterIds = KelasSemester::whereHas('siswa', function ($query) {
            $query->where('status', 'Aktif');
        })
        ->pluck('id')
        ->toArray();

        $naikKelasCountPerKelas = [];
        $tidakNaikKelasCountPerKelas = [];

        foreach ($kelasSemesterIds as $kelasSemesterId) {
            $siswaInKelas = Siswa::where('kelas_semester_id', $kelasSemesterId)->get();

            $naikKelasCount = 0;
            $tidakNaikKelasCount = 0;

            foreach ($siswaInKelas as $siswa) {
                $nilaiSiswa = SiswaMataPelajaran::where('siswa_id', $siswa->id)->get();

                $totalNilaiAkhir = 0;
                $jumlahMataPelajaran = 0;

                foreach ($nilaiSiswa as $nilai) {
                    if ($nilai->nilai_akhir !== null) {
                        $totalNilaiAkhir += $nilai->nilai_akhir;
                        $jumlahMataPelajaran++;
                    }
                }

                $rataRataNilai = $jumlahMataPelajaran > 0 ? $totalNilaiAkhir / $jumlahMataPelajaran : 0;

                if ($rataRataNilai >= 78) {
                    $naikKelasCount++;
                } else {
                    $tidakNaikKelasCount++;
                }
            }

            $kelasNama = KelasSemester::find($kelasSemesterId)->kelas->nama;

            $naikKelasCountPerKelas[$kelasNama] = $naikKelasCount;
            $tidakNaikKelasCountPerKelas[$kelasNama] = $tidakNaikKelasCount;
        }

        return [
            'kelasData' => array_keys($naikKelasCountPerKelas),
            'naikKelas' => array_values($naikKelasCountPerKelas),
            'tidakNaikKelas' => array_values($tidakNaikKelasCountPerKelas),
        ];
    }
}
