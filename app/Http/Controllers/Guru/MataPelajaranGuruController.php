<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\CapaianKompetensi;
use App\Models\GuruKelas;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\KelasSemester;
use App\Models\MataPelajaran;
use App\Models\NilaiMataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\UploadTugas;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataPelajaranGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $data = MataPelajaran::where('user_id', $user->id)->whereHas('kelasSemester', function ($query) use ($user) {
                $query->where('status', 'Aktif');
        })
        ->get();
        // dd($data);

        return view('pages.guru.mata-pelajaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();
        $mataPelajaran = MataPelajaran::where('user_id', $user->id)->where('id', $id)->first();
        // dd($mataPelajaran);
        return view('pages.guru.mata-pelajaran.create', compact('mataPelajaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $mataPelajaranId = $request->mata_pelajaran_id;
        // dd($mataPelajaranId);
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

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $mataPelajaran = MataPelajaran::find($id);
        $data = UploadTugas::where('mata_pelajaran_id', $id)->get();

        return view('pages.guru.mata-pelajaran.show', compact('data', 'mataPelajaran'));
    }

    public function detailInputNilai($id){
        $uploadTugas = UploadTugas::findOrFail($id);
        $mataPelajaran = MataPelajaran::where('id', $uploadTugas->mata_pelajaran_id)->first();

        $siswaMataPelajaran = SiswaMataPelajaran::with(['siswa', 'nilaiSiswa' => function ($query) use ($id) {
            $query->where('upload_tugas_id', $id);
        }])->get();

        $user = Auth::user();
        $kelasId = GuruKelas::where('kelas_id', $mataPelajaran->kelas_id)->value('kelas_id');
        $kelas = KelasSemester::with('kelas')->where('kelas_id', $kelasId)->first();
        $siswa = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('kelas_id', $kelasId);
        })->get();

        $nilaiSiswaMap = [];
        foreach ($siswaMataPelajaran as $siswaMataPelajaranItem) {
            foreach ($siswaMataPelajaranItem->nilaiSiswa as $nilaiSiswa) {
                $nilaiSiswaMap[$siswaMataPelajaranItem->siswa_id] = $nilaiSiswa->nilai;
            }
        }

        return view('pages.guru.mata-pelajaran.input-nilai-tugas', compact('uploadTugas', 'siswa', 'nilaiSiswaMap', 'kelas'));
    }

    public function inputNilaiStoreGuru(Request $request)
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pageInputNilai($id)
    {
        $data = SiswaMataPelajaran::find($id);
        $mataPelajaranId = MataPelajaran::where('id', $data->mata_pelajaran_id)->value('id');
        $uploadTugas = UploadTugas::where('mata_pelajaran_id', $data->mata_pelajaran_id)->get();
        $nilaiMataPelajaran = NilaiMataPelajaran::where('siswa_mata_pelajaran_id', $id)->get();

        return view('pages.guru.mata-pelajaran.input-nilai', compact('data', 'uploadTugas', 'nilaiMataPelajaran', 'mataPelajaranId'));
    }

    public function inputNilaiStore(Request $request)
    {
        $totalNilai = 0;
        $jumlahTugas = count($request->upload_tugas_id);

        foreach ($request->upload_tugas_id as $uploadTugas) {
            $nilaiField = 'nilai_' . $uploadTugas;
            $nilai = $request->$nilaiField;
            $totalNilai += $nilai;

            NilaiMataPelajaran::updateOrCreate(
                ['siswa_mata_pelajaran_id' => $request->siswa_mata_pelajaran_id, 'upload_tugas_id' => $uploadTugas],
                ['nilai' => $nilai]
            );
        }

        $nilaiAkhir = $totalNilai / $jumlahTugas;

        SiswaMataPelajaran::where('id', $request->siswa_mata_pelajaran_id)->update(['nilai_akhir' => $nilaiAkhir]);

        return redirect()->route('mata-pelajaran-guru.show', ['id' => $request->mata_pelajaran_id]);
    }
}
