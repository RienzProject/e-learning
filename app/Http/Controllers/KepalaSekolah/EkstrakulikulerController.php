<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ekstrakulikuler;

class EkstrakulikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ekstrakulikuler::all();
        return view('pages.kepala-sekolah.ekstrakulikuler.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kepala-sekolah.ekstrakulikuler.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData()
{
    // Ambil data dari tabel ekstrakulikuler
    $data = Ekstrakulikuler::select('id', 'nama', 'hari', 'created_at', 'updated_at')->get();
    // Kirim data dalam format JSON sesuai dengan kebutuhan DataTables
    return response()->json(['data' => $data]);
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
        $data = Ekstrakulikuler::find($id);
        
        return view('pages.kepala-sekolah.ekstrakulikuler.edit', compact('data'));
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
        ]);
        
        $data = Ekstrakulikuler::find($id);

        if (!$data) {
            return redirect('/ekstrakulikuler')->with('error', 'Data tidak ditemukan!');
        }
        
        $data->nama = $request->nama;
        $data->hari = $request->hari;

        $data->save();

        return redirect('/ekstrakulikuler');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Ekstrakulikuler::find($id);
        $data->delete();

        return redirect('/ekstrakulikuler');
    }
}
