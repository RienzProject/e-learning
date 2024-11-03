<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\KelasSemester;
use App\Models\Rapor;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class RaporSiswaController extends Controller
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
        $data = Siswa::where('kelas_semester_sebelumnya_id', $kelasId)
            ->whereHas('rapor', function ($query) {
                $query->where('status_rapor', 'Divalidasi');
            })->get();
        // dd($data);
        // $data = Siswa::whereHas('kelasSemester', function($query) use ($kelasId) {
        //     $query->where('status', 'Dibuka');
        //     $query->where('kelas_id', $kelasId);
        // })
        // ->whereHas('rapor', function($query) {
        //     $query->where('status_rapor', 'Divalidasi');
        // })->get();
        // dd($data);

        return view('pages.wali-kelas.rapor-siswa.index', compact('data'));
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
        $rapor = Rapor::where('siswa_id', $siswa->id)->where('status_rapor', 'Divalidasi')->first();

        if ($request->has('lulus')) {
            $siswa->status = 'Lulus';
        } elseif ($request->has('tidak_lulus')) {
            $rapor->status_siswa = 'Tidak Lulus';
            $rapor->save();
        }

        return redirect('/rapor-siswa');
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

    public function unduhRapor($id)
    {
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->pluck('kelas_id');
        $siswa = Siswa::find($id);
        $kelasSemesterSebelumnya = KelasSemester::find($siswa->kelas_semester_sebelumnya_id);
        $rapor = Rapor::where('siswa_id', $id)
            ->where('kelas_semester_id', $kelasId)
            ->where('status_rapor', 'Divalidasi')
            ->first();

        $filePath = public_path($rapor->url_rapor);

        if (File::exists($filePath)) {
            $rapor->status_rapor = 'Selesai Diunduh';
            $rapor->save();

            session()->flash('rapor_downloaded', true);

            return Response::download($filePath);
        }

        return redirect()->back()->withErrors('File tidak ditemukan.');
    }
}
