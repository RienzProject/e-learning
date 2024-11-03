@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <div class="container-fluid py-4">
        <form action="/nilai-siswa" method="POST" role="form text-left">
            @csrf
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Jenis Tugas</h6>
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
                                                <h6 class="mb-0 text-sm">: {{ $uploadTugas->jenis_nilai }}</h6>
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
                                                <h6 class="mb-0 text-sm">: {{ $uploadTugas->nama_tugas }}</h6>
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
                                                <h6 class="mb-0 text-sm">: {{ $uploadTugas->tanggal_penilaian }}</h6>
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
                                            <h6 class="mb-0 text-sm">: {{ $uploadTugas->mataPelajaran->nama }}</h6>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Nilai Siswa</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 mt-2">
                            <table id="myTable" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                        <th class="text-uppercase text-xs font-weight-bolder text-start">Nama Siswa</th>
                                        <th class="text-uppercase text-xs font-weight-bolder text-start">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswaMataPelajaran as $index => $item)
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
                                                        <h6 class="mb-0 text-sm">{{ $item->siswa->nama }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->nilai }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <input type="hidden" name="siswa_id[]" value="{{ $item->id }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                            <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                            <script>
                                let table = new DataTable('#myTable');
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
