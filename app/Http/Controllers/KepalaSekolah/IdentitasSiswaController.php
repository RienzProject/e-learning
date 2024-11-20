<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\DataOrangTua;
use App\Models\DataSiswa;
use App\Models\KelasSemester;
use App\Models\Rapor;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IdentitasSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Siswa::all();

        return view('pages.kepala-sekolah.identitas-siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelasSemester = KelasSemester::where('status', 'Aktif')->get();
        return view('pages.kepala-sekolah.identitas-siswa.create', compact('kelasSemester'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siswa = new Siswa();
        $siswa->kelas_semester_id = $request->kelas_id;
        $siswa->nama = $request->nama;
        $siswa->NIS = $request->NIS;
        $siswa->NISN = $request->NISN;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tempat_Lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->agama = $request->agama;
        $siswa->pendidikan_sebelumnya = $request->pendidikan_sebelumnya;
        $siswa->alamat = $request->alamat;

        $file = $request->file('foto');
        $namaFile = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/foto-siswa', $namaFile);
        $siswa->foto = $namaFile;

        $siswa->save();

        $dataOrangTua = new DataOrangTua();
        $dataOrangTua->siswa_id = $siswa->id;
        $dataOrangTua->nama_ayah = $request->nama_ayah;
        $dataOrangTua->nama_ibu = $request->nama_ibu;
        $dataOrangTua->pekerjaan_ayah = $request->pekerjaan_ayah;
        $dataOrangTua->pekerjaan_ibu = $request->pekerjaan_ibu;
        $dataOrangTua->jalan = $request->jalan;
        $dataOrangTua->kelurahan = $request->kelurahan;
        $dataOrangTua->kecamatan = $request->kecamatan;
        $dataOrangTua->kota = $request->kota;
        $dataOrangTua->provinsi = $request->provinsi;
        $dataOrangTua->save();

        $rapor = new Rapor();
        $rapor->siswa_id = $siswa->id;
        $rapor->save();

        return redirect('/identitas-siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::find($id);
        return view('pages.kepala-sekolah.identitas-siswa.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Siswa::find($id);
        return view('pages.kepala-sekolah.identitas-siswa.edit', compact('data'));
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
        $siswa->nama = $request->nama;
        $siswa->NIS = $request->NIS;
        $siswa->NISN = $request->NISN;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tempat_Lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->agama = $request->agama;
        $siswa->pendidikan_sebelumnya = $request->pendidikan_sebelumnya;
        $siswa->alamat = $request->alamat;

        if ($siswa->foto) {
            Storage::delete('public/foto-siswa/' . $siswa->foto);
        }

        $file = $request->file('foto');
        $namaFile = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/foto-siswa', $namaFile);
        $siswa->foto = $namaFile;

        $siswa->save();

        $dataOrangTua = DataOrangTua::where('siswa_id', $siswa->id)->first();
        $dataOrangTua->siswa_id = $siswa->id;
        $dataOrangTua->nama_ayah = $request->nama_ayah;
        $dataOrangTua->nama_ibu = $request->nama_ibu;
        $dataOrangTua->pekerjaan_ayah = $request->pekerjaan_ayah;
        $dataOrangTua->pekerjaan_ibu = $request->pekerjaan_ibu;
        $dataOrangTua->jalan = $request->jalan;
        $dataOrangTua->kelurahan = $request->kelurahan;
        $dataOrangTua->kecamatan = $request->kecamatan;
        $dataOrangTua->kota = $request->kota;
        $dataOrangTua->provinsi = $request->provinsi;
        $dataOrangTua->save();

        return redirect('/identitas-siswa');
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
