@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <div class="container-fluid py-4">
        <form action="/nilai-siswa" method="POST" role="form text-left">
            @csrf
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Menentukkan Jenis Tugas</h6>
                </div>
                <div class="card-body pt-4 p-3">

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Jenis Nilai</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <select class="form-control" id="jenis_nilai" name="jenis_nilai" required>
                                                    <option value="" disabled selected>Pilih Jenis Nilai</option>
                                                    <option value="Harian">Harian</option>
                                                    <option value="UTS">UTS</option>
                                                    <option value="UAS">UAS</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Nama Tugas</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <input class="form-control" type="text" placeholder="Masukkan Nama Tugas"
                                                    name="nama_tugas" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Tanggal Penilaian</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <input class="form-control" type="date" name="tanggal_penilaian"
                                                    required>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Mata Pelajaran</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
<<<<<<< HEAD
                                            <select class="form-control" id="mata_pelajaran_id" name="mata_pelajaran_id" required>
=======
                                            <select class="form-control" id="mata_pelajaran_id" name="mata_pelajaran_id"
                                                required>
>>>>>>> julio
                                                <option value="" disabled selected>Pilih Mata Pelajaran</option>
                                                @foreach ($mataPelajaran as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
<<<<<<< HEAD

                </div>
            </div>
            <div class="card mt-3">
=======
                    <div class="d-flex justify-content-end">
                        <a href="/nilai-siswa" class="btn btn-danger mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn btn-info mt-4 mb-4">Submit</button>
                    </div>
                </div>
            </div>
            {{-- <div class="card mt-3">
>>>>>>> julio
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Input Nilai Siswa</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="/presensi" method="POST" role="form text-left">
                        @csrf
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0 mt-2">
                                <table id="myTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                            <th class="text-uppercase text-xs font-weight-bolder">Nama Siswa</th>
                                            <th class="text-uppercase text-xs font-weight-bolder">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $index => $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $item->nama }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <input class="form-control" type="number" min="0"
                                                            max="100" placeholder="Masukkan Nilai" name="nilai[]"
                                                            required>
                                                    </div>
                                                </td>
                                                <input type="hidden" name="siswa_id[]" value="{{ $item->id }}">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
<<<<<<< HEAD
                        <div class="d-flex justify-content-end">
                            <a href="/presensi" class="btn btn-danger mt-4 mb-4 me-2">Kembali</a>
                            <button type="submit" class="btn btn-info mt-4 mb-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
=======

                    </form>
                </div>
            </div> --}}
>>>>>>> julio
        </form>
    </div>
@endsection
