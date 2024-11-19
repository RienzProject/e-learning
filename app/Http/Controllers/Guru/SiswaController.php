<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\GuruKelas;
use App\Models\KelasSemester;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kelasId = GuruKelas::where('user_id', $user->id)->pluck('kelas_id');
        $kelas = KelasSemester::whereIn('kelas_id', $kelasId)->get();

        return view('pages.guru.siswa.index', compact('kelas'));
    }

    public function show($id) {
        $user = Auth::user();

        $kelasId = GuruKelas::where('user_id', $user->id)->pluck('kelas_id')->toArray();

        $kelas = KelasSemester::where('kelas_id', $id)->first();

        $data = Siswa::whereHas('kelasSemester', function($query) use ($kelasId, $id) {
            $query->where('status', 'Aktif');
            $query->where('kelas_id', $id);
        })
        ->get();

        return view('pages.guru.siswa.show', compact('data', 'kelas'));
    }

    public function detailSiswa($id) {
        $data = Siswa::findOrFail($id);
        return view('pages.guru.siswa.detail_siswa', compact('data'));
    }
}
