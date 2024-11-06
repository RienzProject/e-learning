<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\KelasSemester;
use App\Models\RuangPresensi;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KelolaRuangPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');
        $data = RuangPresensi::where('user_id', $user->id)->whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('status', 'Aktif');
            $query->where('kelas_id', '=', $kelasId);
        })
            ->get();

        return view('pages.wali-kelas.kelola-ruang-presensi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $today = date('Y-m-d');
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');
        $semester = KelasSemester::where('status', '=', 'Aktif')->where('kelas_id', $kelasId)->get();

        return view('pages.wali-kelas.kelola-ruang-presensi.create', compact('semester', 'today'));
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

        $today = Carbon::today();

        $tanggalPresensi = Carbon::parse($request->tanggal_presensi);

        if ($tanggalPresensi->gt($today)) {
            return redirect()->back()->with('error', 'Tanggal presensi tidak boleh lebih dari hari ini.');
        }

        $existingRuangPresensi = RuangPresensi::where('kelas_semester_id', $request->semester_id)
            ->where('tanggal_presensi', $request->tanggal_presensi)
            ->exists();

        if ($existingRuangPresensi) {
            return redirect()->back()->with('error', 'Presensi sudah dibuat untuk tanggal tersebut.');
        }

        $ruangPresensi = new RuangPresensi();
        $ruangPresensi->kelas_semester_id = $request->semester_id;
        $ruangPresensi->user_id = $user->id;
        $ruangPresensi->tanggal_presensi = $request->tanggal_presensi;
        $ruangPresensi->save();

        return redirect()->back()->with('success', 'Ruang presensi berhasil dibuat.');
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
        $data = RuangPresensi::find($id);
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');
        $semester = KelasSemester::where('status', '=', 'Aktif')->where('kelas_id', $kelasId)->get();

        return view('pages.wali-kelas.kelola-ruang-presensi.edit', compact('data', 'semester'));
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
        $ruangPresensi = RuangPresensi::find($id);
        $ruangPresensi->kelas_semester_id = $request->semester_id;
        $ruangPresensi->tanggal_presensi = $request->tanggal_presensi;
        $ruangPresensi->save();

        return redirect('/kelola-ruang-presensi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruangPresensi = RuangPresensi::find($id);
        $ruangPresensi->delete();

        return redirect('/kelola-ruang-presensi');
    }
}
