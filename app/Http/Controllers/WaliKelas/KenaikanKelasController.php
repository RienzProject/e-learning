<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\KelasSemester;
use App\Models\Rapor;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KenaikanKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->pluck('kelas_id');
        $data = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('status', 'Dibuka');
            $query->where('kelas_id', $kelasId);
        })->get();
        $kelasSemester = KelasSemester::all();

        return view('pages.wali-kelas.kenaikan-kelas.index', compact('data', 'kelasSemester'));
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
        //
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
        $siswa = Siswa::find($id);
        $rapor = Rapor::where('siswa_id', $siswa->id)->first();
        
        if ($request->has('lulus')) {
            $siswa->kelas_semester_sebelumnya_id = $siswa->kelas_semester_id;
            $siswa->kelas_semester_id = $request->kelas_semester_id;
            $siswa->save();

            $rapor->status_siswa = 'Lulus';
            $rapor->save();

            $raporBaru = new Rapor();
            $raporBaru->siswa_id = $id;
            $raporBaru->kelas_semester_id = $request->kelas_semester_id;
            $raporBaru->save();
        } elseif ($request->has('tidak_lulus')) {
            $siswa->kelas_semester_sebelumnya_id = $siswa->kelas_semester_id;
            $siswa->save();
            
            $rapor->status_siswa = 'Tidak Lulus';
            $rapor->save();

            $raporBaru = new Rapor();
            $raporBaru->siswa_id = $id;
            $raporBaru->kelas_semester_id = $siswa->kelas_semester_id;
            $raporBaru->save();
        }

        return redirect('/kenaikan-kelas');
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
}
