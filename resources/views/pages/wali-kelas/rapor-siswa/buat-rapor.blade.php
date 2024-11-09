@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <style>
        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6 !important;
        }

        thead th {
            text-align: center;
        }
    </style>

    <div class="container-fluid py-4">
        <!-- Biodata Siswa -->
        <div class="card mb-4">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Biodata Siswa</h6>
            </div>
            <div class="card-body pt-3">
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td style="padding: 0; width: 200px; vertical-align: middle;"><strong
                                            class="text-dark">Nama Peserta Didik</strong></td>
                                    <td style="padding: 0;">: &nbsp; {{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0; width: 200px; vertical-align: middle;"><strong
                                            class="text-dark">NISN</strong></td>
                                    <td style="padding: 0;">: &nbsp; {{ $siswa->NISN }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0; width: 200px; vertical-align: middle;"><strong
                                            class="text-dark">Sekolah</strong></td>
                                    <td style="padding: 0;">: &nbsp; SD Negeri 009 Marangkarayu</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0; width: 200px; vertical-align: middle;"><strong
                                            class="text-dark">Alamat</strong></td>
                                    <td style="padding: 0;">: &nbsp; {{ $siswa->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td style="padding: 0; width: 200px; vertical-align: middle;"><strong
                                            class="text-dark">Kelas</strong></td>
                                    <td style="padding: 0;">: &nbsp; {{ $siswa->kelasSemester->kelas->nama }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0; width: 200px; vertical-align: middle;"><strong
                                            class="text-dark">Semester</strong></td>
                                    <td style="padding: 0;">: &nbsp; {{ $siswa->kelasSemester->semester->nama }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0; width: 200px; vertical-align: middle;"><strong
                                            class="text-dark">Tahun Pelajaran</strong></td>
                                    <td style="padding: 0;">: &nbsp;
                                        {{ $siswa->kelasSemester->semester->awal_tahun_ajaran }} /
                                        {{ $siswa->kelasSemester->semester->akhir_tahun_ajaran }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>

        <!-- Rapor Siswa -->
        <div class="card mb-4">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Rapor Siswa</h6>
            </div>
            <div class="card-body pt-3">

                <div class="table-responsive mt-4">
                    <table class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 5%;">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 25%;">Mata
                                    Pelajaran</th>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 15%;">Nilai
                                    Akhir</th>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 55%;">Capaian
                                    Kompetensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswaMataPelajaran as $index => $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $index + 1 }}</td>
                                    <td class="text-center align-middle">{{ $item->mataPelajaran->nama }}</td>
                                    <td class="text-center align-middle">{{ $item->nilai_akhir }}</td>
                                    <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">
                                        {{ $item->capaianKompetensi->catatan }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td style="padding: 0; width: 200px;"><strong class="text-dark">Nilai Rapor</strong></td>
                            <td style="padding: 0;">: &nbsp; {{ intval($nilaiRapor) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0; width: 200px;"><strong class="text-dark">Status Naik Kelas</strong></td>
                            <td style="padding: 0;">: &nbsp; {{ $statusNaikKelas }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Muatan Lokal -->
        <div class="card mb-4">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Muatan Lokal</h6>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 5%;">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 25%;">
                                    Ekstrakurikuler</th>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 15%;">
                                    Predikat</th>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 55%;">
                                    Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ekstrakulikuler as $index => $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $index + 1 }}</td>
                                    <td class="text-center align-middle">{{ $item->ekstrakulikuler->nama }}</td>
                                    <td class="text-center align-middle">{{ $item->predikat }}</td>
                                    <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">
                                        {{ $item->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Ketidakhadiran -->
        <div class="card mb-4">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Ketidakhadiran</h6>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" style="width: 100%;">
                        {{-- <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 25%;">Status
                                    Presensi</th>
                                <th class="text-uppercase text-xs font-weight-bolder" style="width: 15%;">Jumlah
                                </th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            @foreach ($presensiGrouped as $item)
                                <tr>
                                    <td style="width: 50%;">{{ $item->status_presensi }}</td>
                                    <td style="width: 50%;">{{ $item->count }} hari</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Aksi Kembali dan Validasi -->
        <div class="d-flex justify-content-end mt-4">
            <a href="/rapor-siswa" class="btn btn-danger me-2">Kembali</a>
            @if (!$rapor)
                <form action="/buat-rapor-siswa/{{ $siswa->id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-info">Validasi</button>
                </form>
            @endif
        </div>
    </div>
@endsection
