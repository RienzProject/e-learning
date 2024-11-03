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

        foreach ($request->siswa_id as $index => $siswaId) {
            $siswaMataPelajaran = SiswaMataPelajaran::where('siswa_id', $siswaId)->where('mata_pelajaran_id', $request->mata_pelajaran_id)->first();

            if ($siswaMataPelajaran) {
                $nilaiSiswa = new NilaiSiswa();
                $nilaiSiswa->siswa_mata_pelajaran_id = $siswaMataPelajaran->id;
                $nilaiSiswa->upload_tugas_id = $uploadTugas->id;
                $nilaiSiswa->nilai = $request->nilai[$index];

                $nilaiSiswa->save();
            }
        }

        return redirect('/nilai-siswa');
    }

    public function show($id)
    {
        $uploadTugas = UploadTugas::find($id);
        $siswaMataPelajaran = SiswaMataPelajaran::whereHas('nilaiSiswa', function ($query) use ($id) {
            $query->where('upload_tugas_id', '=', $id);
        })->with('siswa', 'nilaiSiswa.uploadTugas')->get();

        foreach ($siswaMataPelajaran as $item) {
            $nilaiSiswa = $item->nilaiSiswa->firstWhere('upload_tugas_id', $id);
            $item->nilai = $nilaiSiswa ? $nilaiSiswa->nilai : null;
        }

        return view('pages.wali-kelas.nilai-siswa.cek-nilai-siswa', compact('uploadTugas', 'siswaMataPelajaran'));
    }
}
