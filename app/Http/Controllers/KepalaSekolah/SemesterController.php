<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\KelasSemester;
use App\Models\Semester;
use App\Models\WaliKelas;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KelasSemester::with('kelas', 'semester')->get();
        return view('pages.kepala-sekolah.semester.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('pages.kepala-sekolah.semester.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingAwalTahunAjaran = Semester::where('awal_tahun_ajaran', $request->awal_tahun_ajaran)->first();

        if($existingAwalTahunAjaran) {
            return redirect()->back()->with('error', 'Awal tahun ajaran sudah ada di database.');
        }

        foreach ($request->nama as $namaSemester) {
            $semester = new Semester();
            $semester->awal_tahun_ajaran = $request->awal_tahun_ajaran;
            $semester->akhir_tahun_ajaran = $request->akhir_tahun_ajaran;
            $semester->nama = $namaSemester;
            $semester->tanggal_mulai = $request->tanggal_mulai;
            $semester->tanggal_akhir = $request->tanggal_akhir;
            $semester->save();
            
            foreach ($request->kelas_id as $kelasId) {
                $kelasSemester = new KelasSemester();
                $kelasSemester->kelas_id = $kelasId;
                $kelasSemester->semester_id = $semester->id;
                $kelasSemester->status = 'Non Aktif';
                $kelasSemester->save();
            }
        }

        return redirect('/semester');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KelasSemester::find($id);
        return view('pages.kepala-sekolah.semester.edit', compact('data'));
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
        $existingAwalTahunAjaran = Semester::where('awal_tahun_ajaran', $request->awal_tahun_ajaran)->first();

        if($existingAwalTahunAjaran) {
            return redirect()->back()->with('error', 'Awal tahun ajaran sudah ada di database.');
        }

        $kelasSemester = KelasSemester::find($id);

        $semester = Semester::where('id', $kelasSemester->semester_id)->first();
        $semester->awal_tahun_ajaran = $request->awal_tahun_ajaran;
        $semester->akhir_tahun_ajaran = $request->akhir_tahun_ajaran;
        $semester->nama = $request->nama;
        $semester->tanggal_mulai = $request->tanggal_mulai;
        $semester->tanggal_akhir = $request->tanggal_akhir;
        $semester->save();

        $kelasSemester->kelas_id = $request->kelas_id;
        $kelasSemester->semester_id = $semester->id;
        $kelasSemester->save();

        return redirect('/semester');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelasSemester = KelasSemester::find($id);
        $kelasSemester->delete();

        return redirect('/semester');
    }

    public function ubahStatus(Request $request, $id)
    {
        $kelasSemester = KelasSemester::find($id);

        if ($request->status == 'Aktif') {
            $semesterAktif = KelasSemester::where('kelas_id', $kelasSemester->kelas_id)
                                           ->where('status', 'Aktif')
                                           ->where('id', '!=', $id)
                                           ->first();
    
            if ($semesterAktif) {
                return redirect()->back()->with('error', 'Tidak bisa mengaktifkan semester ini. Hanya satu semester yang bisa aktif untuk kelas yang sama.');
            }
        }

        $kelasSemester->status = $request->status;
        $kelasSemester->save();

        return redirect('/semester');
    }
}
