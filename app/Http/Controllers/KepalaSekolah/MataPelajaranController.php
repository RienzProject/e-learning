<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\KelasSemester;
use App\Models\MataPelajaran;
use App\Models\NilaiMataPelajaran;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\UploadTugas;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Support\Facades\Auth;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $data = MataPelajaran::all();

        return view('pages.kepala-sekolah.mata-pelajaran.index', compact('data'));
    }

    public function create()
    {
        $guruPengampu = User::where('role', '!=', 'Kepala Sekolah')
            ->where('role', 'Wali Kelas')
            ->orWhere('role', 'Guru')
            ->get();
        $semuaKelas = Kelas::all();

        return view('pages.kepala-sekolah.mata-pelajaran.create', compact('guruPengampu', 'semuaKelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:100',
            'jenis' => 'required|string',
            'user_id' => 'required|array',
        ]);

        foreach ($request->user_id as $userId) {
            if ($request->has('kelas_' . $userId)) {
                $kelasDipilih = $request->input('kelas_' . $userId);

                foreach ($kelasDipilih as $kelasId) {
                    $mataPelajaran = MataPelajaran::create([
                        'kode' => $request->kode,
                        'nama' => $request->nama,
                        'jenis' => $request->jenis,
                        'user_id' => $userId,
                        'kelas_id' => $kelasId
                    ]);

                    $siswas = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
                        $query->where('kelas_id', $kelasId);
                    })->get();

                    foreach ($siswas as $siswa) {
                        SiswaMataPelajaran::updateOrCreate(
                            ['siswa_id' => $siswa->id, 'mata_pelajaran_id' => $mataPelajaran->id],
                            ['siswa_id' => $siswa->id, 'mata_pelajaran_id' => $mataPelajaran->id]
                        );
                    }
                }
            } else {
                $waliKelas = WaliKelas::where('user_id', $userId)->first();
                $kelasId = $waliKelas->kelas_id;
                $mataPelajaran = MataPelajaran::create([
                    'kode' => $request->kode,
                    'nama' => $request->nama,
                    'jenis' => $request->jenis,
                    'user_id' => $userId,
                    'kelas_id' => $waliKelas->kelas_id
                ]);

                $siswas = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
                    $query->where('kelas_id', $kelasId);
                })->get();

                foreach ($siswas as $siswa) {
                    SiswaMataPelajaran::updateOrCreate(
                        ['siswa_id' => $siswa->id, 'mata_pelajaran_id' => $mataPelajaran->id],
                        ['siswa_id' => $siswa->id, 'mata_pelajaran_id' => $mataPelajaran->id]
                    );
                }
            }
        }

        if ($request->siswa_id) {
            foreach ($request->siswa_id as $siswaId) {
                SiswaMataPelajaran::updateOrCreate(
                    ['siswa_id' => $siswaId, 'mata_pelajaran_id' => $mataPelajaran->id],
                    ['siswa_id' => $siswaId, 'mata_pelajaran_id' => $mataPelajaran->id]
                );
            }
        }

        return redirect('/mata-pelajaran/create');
    }

    public function destroy($id)
    {
        $mataPelajaran = MataPelajaran::find($id);
        $mataPelajaran->delete();

        return redirect('/mata-pelajaran');
    }
}
