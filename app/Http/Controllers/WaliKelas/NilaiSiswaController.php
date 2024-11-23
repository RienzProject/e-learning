<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\CapaianKompetensi;
use App\Models\KelasSemester;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\UploadTugas;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NilaiSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $waliKelas = WaliKelas::where('user_id', $user->id)->first();
        // $data = UploadTugas::all();

        // tambahan where('user_id', $user->id) jika ingin hanya mata pelajaran wali kelas itu aja
        $data = UploadTugas::whereHas('mataPelajaran', function ($query) use ($waliKelas) {
            $query->where('kelas_id', $waliKelas->kelas_id);
        })
        ->whereHas('mataPelajaran.kelasSemester', function ($query) {
            $query->where('status', 'Aktif');
        })
        ->get();

        return view('pages.wali-kelas.nilai-siswa.index', compact('data'));
    }

    public function create()
    {
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');
        $siswa = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('kelas_id', '=', $kelasId);
        })->get();
        // $mataPelajaran = MataPelajaran::where('kelas_id', '=', $kelasId)->get();
        $mataPelajaran = MataPelajaran::where('user_id', $user->id)->get();

        return view('pages.wali-kelas.nilai-siswa.create', compact('siswa', 'mataPelajaran'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $mataPelajaranId = $request->mata_pelajaran_id;
        $jenisNilai = $request->jenis_nilai;

        if ($jenisNilai == 'UTS' || $jenisNilai == 'UAS') {
            $existingTugasBySameTeacher = UploadTugas::where('mata_pelajaran_id', $mataPelajaranId)
                                                      ->where('jenis_nilai', $jenisNilai)
                                                      ->where('user_id', $user->id)
                                                      ->exists();

            if ($existingTugasBySameTeacher) {
                return redirect()->back()->with('error', "Tugas $jenisNilai untuk mata pelajaran ini sudah Anda buat.");
            }

            // $existingTugasByOtherTeacher = UploadTugas::where('mata_pelajaran_id', $mataPelajaranId)
            //                                           ->where('jenis_nilai', $jenisNilai)
            //                                           ->where('user_id', '!=', $user->id)
            //                                           ->exists();

            // if ($existingTugasByOtherTeacher) {
            // }
        }

        $uploadTugas = new UploadTugas();
        $uploadTugas->user_id = $user->id;
        $uploadTugas->mata_pelajaran_id = $mataPelajaranId;
        $uploadTugas->jenis_nilai = $jenisNilai;
        $uploadTugas->nama_tugas = $request->nama_tugas;
        $uploadTugas->tanggal_penilaian = $request->tanggal_penilaian;

        $uploadTugas->save();

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
        $kelas = KelasSemester::with('kelas')->where('kelas_id', $kelasId)->first();
        // dd($kelas);
        $siswa = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('kelas_id', $kelasId);
        })->get();

        $nilaiSiswaMap = [];
        foreach ($siswaMataPelajaran as $siswaMataPelajaranItem) {
            foreach ($siswaMataPelajaranItem->nilaiSiswa as $nilaiSiswa) {
                $nilaiSiswaMap[$siswaMataPelajaranItem->siswa_id] = $nilaiSiswa->nilai;
            }
        }

        return view('pages.wali-kelas.nilai-siswa.cek-nilai-siswa', compact('uploadTugas', 'siswa', 'nilaiSiswaMap', 'kelas'));
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

            if (!$siswaMataPelajaran) {
                $siswaMataPelajaran = SiswaMataPelajaran::create([
                    'siswa_id' => $siswaId,
                    'mata_pelajaran_id' => $request->mata_pelajaran_id,
                    'nilai_akhir' => 0,
                ]);
            }

            if ($siswaMataPelajaran) {
                $nilaiSiswa = NilaiSiswa::updateOrCreate(
                    [
                        'siswa_mata_pelajaran_id' => $siswaMataPelajaran->id,
                        'upload_tugas_id' => $uploadTugas->id,
                    ],
                    ['nilai' => $request->nilai[$index]]
                );
                $this->hitungNilaiAkhir($siswaMataPelajaran);
                $this->updateCapaianKompetensi($siswaMataPelajaran);
            }
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }

    private function hitungNilaiAkhir(SiswaMataPelajaran $siswaMataPelajaran)
    {
        $nilaiSiswa = $siswaMataPelajaran->nilaiSiswa;
        if ($nilaiSiswa->isNotEmpty()) {
            $totalNilai = 0;
            $jumlahNilaiBobot = 0;

            foreach ($nilaiSiswa as $nilai) {
                $uploadTugas = $nilai->uploadTugas;

                if ($uploadTugas && $uploadTugas->jenis_nilai == 'UAS') {
                    $totalNilai += $nilai->nilai * 2;
                    $jumlahNilaiBobot += 2;
                } else {
                    $totalNilai += $nilai->nilai;
                    $jumlahNilaiBobot += 1;
                }
            }

            $nilaiAkhir = $totalNilai / $jumlahNilaiBobot;

            $siswaMataPelajaran->nilai_akhir = $nilaiAkhir;
            $siswaMataPelajaran->save();
        } else {
            $siswaMataPelajaran->nilai_akhir = 0;
            $siswaMataPelajaran->save();
        }
    }

    private function updateCapaianKompetensi(SiswaMataPelajaran $siswaMataPelajaran)
    {
        $nilaiAkhir = $siswaMataPelajaran->nilai_akhir;

        if ($nilaiAkhir >= 78) {
            $catatan = $siswaMataPelajaran->siswa->nama . " sudah menunjukkan kemajuan yang luar biasa dalam memahami materi " . $siswaMataPelajaran->mataPelajaran->nama . ". ". $siswaMataPelajaran->siswa->nama ." telah menguasai konsep-konsep utama dengan baik. Pertahankan usaha ini dan terus belajar dengan semangat. Masa depan cerah menantimu jika tetap konsisten!";
        } else {
            $catatan = $siswaMataPelajaran->siswa->nama . " perlu lebih banyak berlatih di mata pelajaran " . $siswaMataPelajaran->mataPelajaran->nama . ". Walaupun hasilnya belum memuaskan, ini adalah kesempatan untuk belajar lebih banyak. Fokuskan usaha pada bagian yang sulit dan jangan ragu meminta bantuan. Teruslah berusaha, ". $siswaMataPelajaran->siswa->nama ." pasti bisa lebih baik!";
        }

        CapaianKompetensi::updateOrCreate(
            ['siswa_mata_pelajaran_id' => $siswaMataPelajaran->id],
            ['catatan' => $catatan]
        );
    }
}
