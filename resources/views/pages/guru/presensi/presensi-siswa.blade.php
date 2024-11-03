@extends('layouts.user_type.guru.form')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Presensi Siswa</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/presensi-guru" method="POST" role="form text-left">
                    @csrf
                    <input type="hidden" name="ruang_presensi_id" value="{{ $ruangPresensi->id }}">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="myTable" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                        <th class="text-uppercase text-xs font-weight-bolder">Nama Siswa</th>
                                        <th class="text-uppercase text-xs font-weight-bolder">Status Presensi</th>
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
                                                    <select name="status_presensi[]" class="form-select ">
                                                        @php
                                                            $presensi = $item->presensi
                                                                ->where('ruang_presensi_id', $ruangPresensi->id)
                                                                ->first();
                                                        @endphp
                                                        @if ($presensi)
                                                            <option value="Hadir"
                                                                {{ $presensi->status_presensi === 'Hadir' ? 'selected' : '' }}>
                                                                Hadir</option>
                                                            <option value="Sakit"
                                                                {{ $presensi->status_presensi === 'Sakit' ? 'selected' : '' }}>
                                                                Sakit</option>
                                                            <option value="Izin"
                                                                {{ $presensi->status_presensi === 'Izin' ? 'selected' : '' }}>
                                                                Izin</option>
                                                            <option value="Tanpa Keterangan"
                                                                {{ $presensi->status_presensi === 'Tanpa Keterangan' ? 'selected' : '' }}>
                                                                Tanpa Keterangan</option>
                                                        @else
                                                            <option value="Hadir">Hadir</option>
                                                            <option value="Sakit">Sakit</option>
                                                            <option value="Izin">Izin</option>
                                                            <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                                        @endif
                                                    </select>

                                                    <input type="hidden" name="siswa_id[]" value="{{ $item->id }}">
                                                </div>
                                            </td>
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
                    <div class="d-flex justify-content-end">
                        <a href="/presensi-guru" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Submit' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
