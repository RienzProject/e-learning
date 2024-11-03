<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = JadwalKelas::whereHas('mataPelajaran', function($query) use ($user){
            $query->where('user_id', $user->id)
                  ->whereHas('kelasSemester', function($query) {
                      $query->where('status', 'Dibuka');
                  });
        })->get();
        
        return view('pages.wali-kelas.jadwal-kelas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mataPelajaran = MataPelajaran::all();

        return view('pages.wali-kelas.jadwal-kelas.create', compact('mataPelajaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jadwalKelas = new JadwalKelas();
        $jadwalKelas->hari = $request->hari;
        $jadwalKelas->mata_pelajaran_id = $request->mata_pelajaran_id;
        
        $jadwalKelas->save();

        return redirect('/jadwal-kelas');
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
        $data = JadwalKelas::find($id);
        $mataPelajaran = MataPelajaran::all();

        return view('pages.wali-kelas.jadwal-kelas.edit', compact('data', 'mataPelajaran'));
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
        $jadwalKelas = JadwalKelas::find($id);
        $jadwalKelas->hari = $request->hari;
        $jadwalKelas->mata_pelajaran_id = $request->mata_pelajaran_id;
        
        $jadwalKelas->save();

        return redirect('/jadwal-kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwalKelas = JadwalKelas::find($id);
        $jadwalKelas->delete();

        return redirect('/jadwal-kelas');
    }
}
