<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler;
use App\Models\EkstrakulikulerSiswa;
use App\Models\KelasSemester;
use App\Models\Presensi;
use App\Models\Rapor;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\User;
use App\Models\WaliKelas;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');
        $siswa = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('kelas_id', '=', $kelasId);
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

        return view('pages.wali-kelas.rapor-siswa.index', compact('siswa'));
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
        $siswa = Siswa::with(['kelasSemester', 'presensi', 'ekstrakulikuler'])
                  ->where('id', $id)->findOrFail($id);

        $rapor = Rapor::where('siswa_id', $id)->first();

        $siswaMataPelajaran = SiswaMataPelajaran::with([
            'mataPelajaran',
            'nilaiSiswa' => function ($query) use ($id) {
                $query->where('upload_tugas_id', $id);
            },
            'capaianKompetensi'
        ])
        ->where('siswa_mata_pelajaran.siswa_id', $id)
        ->whereHas('mataPelajaran', function($query) {
            $query->where('jenis', 'Mata Pelajaran');
        })
        ->get();

        $siswaMuatanPelajaran = SiswaMataPelajaran::with([
            'mataPelajaran',
            'nilaiSiswa' => function ($query) use ($id) {
                $query->where('upload_tugas_id', $id);
            },
            'capaianKompetensi'
        ])
        ->where('siswa_mata_pelajaran.siswa_id', $id)
        ->whereHas('mataPelajaran', function($query) {
            $query->where('jenis', 'Muatan Pelajaran');
        })
        ->get();

        $ekstrakulikuler = EkstrakulikulerSiswa::with('ekstrakulikuler')
        ->where('siswa_id', $id)
        ->get();

        $presensi = Presensi::where('siswa_id', $id)
            ->select('status_presensi', DB::raw('count(*) as count'))
            ->groupBy('status_presensi')
            ->get();

        $statuses = ['Sakit', 'Izin', 'Tanpa Keterangan'];

        $presensiGrouped = collect();

        foreach ($statuses as $status) {
            $presensiGrouped->push(
                $presensi->firstWhere('status_presensi', $status) ?? (object) ['status_presensi' => $status, 'count' => 0]
            );
        }

        $totalNilaiAkhir = 0;
        $jumlahMataPelajaran = 0;

        foreach ($siswaMataPelajaran as $mapel) {
            if ($mapel->nilai_akhir !== null) {
                $totalNilaiAkhir += $mapel->nilai_akhir;
                $jumlahMataPelajaran++;
            }
        }

        if ($jumlahMataPelajaran > 0) {
            $nilaiRapor = $totalNilaiAkhir / $jumlahMataPelajaran;
        } else {
            $nilaiRapor = 0;
        }

        $statusNaikKelas = ($nilaiRapor >= 78) ? 'Naik Kelas' : 'Tidak Naik Kelas';

        return view('pages.wali-kelas.rapor-siswa.buat-rapor', compact('siswa', 'siswaMataPelajaran', 'siswaMuatanPelajaran', 'nilaiRapor', 'statusNaikKelas', 'rapor', 'ekstrakulikuler', 'presensiGrouped'));
    }

    public function storeRapor($id)
    {
        $siswa = Siswa::find($id);

        $siswaMataPelajaran = SiswaMataPelajaran::with(['mataPelajaran', 'nilaiSiswa' => function ($query) use ($id) {
            $query->where('upload_tugas_id', $id);
        }])->where('siswa_id', $id)->get();

        $totalNilaiAkhir = 0;
        $jumlahMataPelajaran = 0;

        foreach ($siswaMataPelajaran as $mapel) {
            if ($mapel->nilai_akhir !== null) {
                $totalNilaiAkhir += $mapel->nilai_akhir;
                $jumlahMataPelajaran++;
            }
        }

        $nilaiRapor = 0;
        if ($jumlahMataPelajaran > 0) {
            $nilaiRapor = $totalNilaiAkhir / $jumlahMataPelajaran;
        }

        $statusNaikKelas = ($nilaiRapor >= 78) ? 'Naik Kelas' : 'Tidak Naik Kelas';

        $kelasSemesterId = $siswa->kelasSemester()->latest()->first()->id;

        $rapor = Rapor::create([
            'siswa_id' => $siswa->id,
            'kelas_semester_id' => $kelasSemesterId,
            'status_rapor' => 'Divalidasi',
            'status_siswa' => $statusNaikKelas,
            'url_rapor' => null,
        ]);

        return redirect('/rapor-siswa');
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

    public function pdfRapor($id) {
        $user = Auth::user()->load('waliKelas');
        $siswa = Siswa::with(['kelasSemester', 'presensi', 'ekstrakulikuler'])
                  ->where('id', $id)->findOrFail($id);

        $kepalaSekolah = User::where('role', 'Kepala Sekolah')->first();

        $rapor = Rapor::where('siswa_id', $id)->first();

        $siswaMataPelajaran = SiswaMataPelajaran::with([
            'mataPelajaran',
            'nilaiSiswa' => function ($query) use ($id) {
                $query->where('upload_tugas_id', $id);
            },
            'capaianKompetensi'
        ])
        ->where('siswa_mata_pelajaran.siswa_id', $id)
        ->whereHas('mataPelajaran', function($query) {
            $query->where('jenis', 'Mata Pelajaran');
        })
        ->get();

        $siswaMuatanPelajaran = SiswaMataPelajaran::with([
            'mataPelajaran',
            'nilaiSiswa' => function ($query) use ($id) {
                $query->where('upload_tugas_id', $id);
            },
            'capaianKompetensi'
        ])
        ->where('siswa_mata_pelajaran.siswa_id', $id)
        ->whereHas('mataPelajaran', function($query) {
            $query->where('jenis', 'Muatan Pelajaran');
        })
        ->get();

        $ekstrakulikuler = EkstrakulikulerSiswa::with('ekstrakulikuler')
        ->where('siswa_id', $id)
        ->get();

        $presensi = Presensi::where('siswa_id', $id)
            ->select('status_presensi', DB::raw('count(*) as count'))
            ->groupBy('status_presensi')
            ->get();

        $statuses = ['Sakit', 'Izin', 'Tanpa Keterangan'];

        $presensiGrouped = collect();

        foreach ($statuses as $status) {
            $presensiGrouped->push(
                $presensi->firstWhere('status_presensi', $status) ?? (object) ['status_presensi' => $status, 'count' => 0]
            );
        }

        $totalNilaiAkhir = 0;
        $jumlahMataPelajaran = 0;

        foreach ($siswaMataPelajaran as $mapel) {
            if ($mapel->nilai_akhir !== null) {
                $totalNilaiAkhir += $mapel->nilai_akhir;
                $jumlahMataPelajaran++;
            }
        }

        if ($jumlahMataPelajaran > 0) {
            $nilaiRapor = $totalNilaiAkhir / $jumlahMataPelajaran;
        } else {
            $nilaiRapor = 0;
        }

        $name = strtoupper(str_replace(' ', '_', $siswa->nama));
        $dt = strtoupper(Carbon::now()->isoFormat('D_MMMM_Y'));

        $statusNaikKelas = ($nilaiRapor >= 78) ? 'Naik Kelas' : 'Tidak Naik Kelas';

        $pdf = PDF::loadView('pages.wali-kelas.rapor-siswa.rapor', compact('siswa', 'dt','statusNaikKelas', 'user', 'kepalaSekolah' ,'rapor', 'siswaMataPelajaran', 'siswaMuatanPelajaran', 'ekstrakulikuler', 'presensiGrouped'))->setPaper('A4');
        return $pdf->stream('RAPOR_'.$name.('_').$dt.'.pdf');
    }
}
