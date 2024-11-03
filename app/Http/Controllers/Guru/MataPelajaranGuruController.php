<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\KelasSemester;
use App\Models\MataPelajaran;
use App\Models\NilaiMataPelajaran;
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
        $data = MataPelajaran::where('user_id', $user->id)->whereHas('kelasSemester', function ($query) {
            $query->where('status', 'Dibuka');
        })->get();

        return view('pages.guru.mata-pelajaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
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
        $data = SiswaMataPelajaran::where('mata_pelajaran_id', $id)->get();

        return view('pages.guru.mata-pelajaran.show', compact('data', 'mataPelajaran'));
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
