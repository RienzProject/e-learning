@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <div class="container-fluid py-4">
        <form action="/nilai-siswa/input-nilai" method="POST" role="form text-left">
            @csrf
            <input type="hidden" name="upload_tugas_id" value="{{ $uploadTugas->id }}">
            <input type="hidden" name="mata_pelajaran_id" value="{{ $uploadTugas->mataPelajaran->id }}">

            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Jenis Tugas</h6>
                </div>
                <div class="card-body pt- p-3">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <tbody>
                                <tr>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                        <strong class="text-dark" style="width: 150px;">Jenis Nilai</strong>
                                        <span>: &nbsp; {{ $uploadTugas->jenis_nilai }}</span>
                                    </li>
                                </tr>
                                <tr>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                        <strong class="text-dark" style="width: 150px;">Nama Tugas</strong>
                                        <span>: &nbsp; {{ $uploadTugas->nama_tugas }}</span>
                                    </li>
                                </tr>
                                <tr>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                        <strong class="text-dark" style="width: 150px;">Tanggal penilaian</strong>
                                        <span>: &nbsp;
                                            {{ \Carbon\Carbon::parse($uploadTugas->tanggal_penilaian)->isoFormat('D MMMM YYYY') }}
                                        </span>
                                    </li>
                                </tr>
                                <tr>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                        <strong class="text-dark" style="width: 150px;">Mata Pelajaran</strong>
                                        <span>: &nbsp; {{ $uploadTugas->mataPelajaran->nama }}</span>
                                    </li>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Nilai Siswa</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="table-responsive p-0 mt-2">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">Nama Siswa</th>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">Input Nilai</th>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">Nilai</th>
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
                                            <h6 class="mb-0 text-sm">{{ $item->nama }}</h6>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" min="0" max="100"
                                                placeholder="Masukkan Nilai" name="nilai[]"
                                                value="{{ $nilaiSiswaMap[$item->id] ?? '' }}">
                                        </td>
                                        <td>
                                            {{ $nilaiSiswaMap[$item->id] ?? 'Nilai belum diinput' }}
                                        </td>
                                        <input type="hidden" name="siswa_id[]" value="{{ $item->id }}">
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="/nilai-siswa" class="btn btn-danger me-2">Kembali</a>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </div>
        </form>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    </div>
@endsection
