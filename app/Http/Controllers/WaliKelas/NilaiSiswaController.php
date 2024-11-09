<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\UploadTugas;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiSiswaController extends Controller
{
    public function index()
    {
        $data = UploadTugas::all();
        return view('pages.wali-kelas.nilai-siswa.index', compact('data'));
    }

    public function create()
    {
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');
        $siswa = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('kelas_id', '=', $kelasId);
        })->get();
        $mataPelajaran = MataPelajaran::where('kelas_id', '=', $kelasId)->get();

        return view('pages.wali-kelas.nilai-siswa.create', compact('siswa', 'mataPelajaran'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $uploadTugas = new UploadTugas();
        $uploadTugas->user_id = $user->id;
        $uploadTugas->mata_pelajaran_id = $request->mata_pelajaran_id;
        $uploadTugas->jenis_nilai = $request->jenis_nilai;
        $uploadTugas->nama_tugas = $request->nama_tugas;
        $uploadTugas->tanggal_penilaian = $request->tanggal_penilaian;

        $uploadTugas->save();

        // foreach ($request->siswa_id as $index => $siswaId) {
        //     $siswaMataPelajaran = SiswaMataPelajaran::where('siswa_id', $siswaId)->where('mata_pelajaran_id', $request->mata_pelajaran_id)->first();

        //     if ($siswaMataPelajaran) {
        //         $nilaiSiswa = new NilaiSiswa();
        //         $nilaiSiswa->siswa_mata_pelajaran_id = $siswaMataPelajaran->id;
        //         $nilaiSiswa->upload_tugas_id = $uploadTugas->id;
        //         $nilaiSiswa->nilai = $request->nilai[$index];

        //         $nilaiSiswa->save();
        //     }
        // }

        return redirect('/nilai-siswa');
    }

    public function show($id)
    {
        $uploadTugas = UploadTugas::findOrFail($id);

        $siswaMataPelajaran = SiswaMataPelajaran::with(['siswa', 'nilaiSiswa' => function ($query) use ($id) {
            $query->where('upload_tugas_id', $id);
        }])->get();

        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');

        $siswa = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('kelas_id', $kelasId);
        })->get();

        $nilaiSiswaMap = [];
        foreach ($siswaMataPelajaran as $siswaMataPelajaranItem) {
            foreach ($siswaMataPelajaranItem->nilaiSiswa as $nilaiSiswa) {
                $nilaiSiswaMap[$siswaMataPelajaranItem->siswa_id] = $nilaiSiswa->nilai;
            }
        }

        return view('pages.wali-kelas.nilai-siswa.cek-nilai-siswa', compact('uploadTugas', 'siswa', 'nilaiSiswaMap'));
    }

    public function inputNilaiStore(Request $request)
    {
        $request->validate([
            'upload_tugas_id' => 'required|exists:upload_tugas,id',
            'siswa_id' => 'required|array',
            'siswa_id.*' => 'exists:siswa,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'nilai' => 'required|array',
            'nilai.*' => 'numeric',
        ]);

        $uploadTugas = UploadTugas::findOrFail($request->upload_tugas_id);

        foreach ($request->siswa_id as $index => $siswaId) {
            $siswaMataPelajaran = SiswaMataPelajaran::where('siswa_id', $siswaId)
                ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
                ->first();

            if ($siswaMataPelajaran) {
                $nilaiSiswa = NilaiSiswa::updateOrCreate(
                    [
                        'siswa_mata_pelajaran_id' => $siswaMataPelajaran->id,
                        'upload_tugas_id' => $uploadTugas->id,
                    ],
                    ['nilai' => $request->nilai[$index]]
                );

                $this->hitungNilaiAkhir($siswaMataPelajaran);
            }
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }

    private function hitungNilaiAkhir(SiswaMataPelajaran $siswaMataPelajaran)
    {
        $nilaiSiswa = $siswaMataPelajaran->nilaiSiswa;

        if ($nilaiSiswa->isNotEmpty()) {
            $totalNilai = 0;
            $jumlahNilai = 0;

            foreach ($nilaiSiswa as $nilai) {
                $uploadTugas = $nilai->uploadTugas;

                if ($uploadTugas && $uploadTugas->jenis_nilai == 'UAS') {
                    $totalNilai += $nilai->nilai * 2;
                } else {
                    $totalNilai += $nilai->nilai;
                }

                $jumlahNilai++;
            }

            $nilaiAkhir = $totalNilai / $jumlahNilai;

            $siswaMataPelajaran->nilai_akhir = $nilaiAkhir;
            $siswaMataPelajaran->save();
        } else {
            $siswaMataPelajaran->nilai_akhir = 0;
            $siswaMataPelajaran->save();
        }
    }
}
