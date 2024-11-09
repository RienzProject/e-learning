@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Biodata Siswa</h6>
            </div>
            <div class="card-body pt- p-3">
                <div class="table-responsive p-0" style="overflow-x: hidden;">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-5">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                            <strong class="text-dark" style="width: 150px;">NIS</strong>
                                            <span>: &nbsp; {{ $siswa->NIS }}</span>
                                        </li>
                                    </tr>
                                    <tr>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                            <strong class="text-dark" style="width: 150px;">NISN</strong>
                                            <span>: &nbsp; {{ $siswa->NISN }}</span>
                                        </li>
                                    </tr>
                                    <tr>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                            <strong class="text-dark" style="width: 150px;">Nama Siswa</strong>
                                            <span>: &nbsp; {{ $siswa->nama }}</span>
                                        </li>
                                    </tr>
                                    <tr>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                            <strong class="text-dark" style="width: 150px;">Jenis Kelamin</strong>
                                            <span>: &nbsp; {{ $siswa->jenis_kelamin }}</span>
                                        </li>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-7">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                            <strong class="text-dark" style="width: 210px;">Tempat Tanggal Lahir</strong>
                                            <span>: &nbsp;
                                                {{ $siswa->tempat_lahir }},
                                                {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM YYYY') }}
                                            </span>
                                        </li>
                                    </tr>
                                    <tr>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                            <strong class="text-dark" style="width: 210px;">Agama</strong>
                                            <span>: &nbsp; {{ $siswa->agama }}</span>
                                        </li>
                                    </tr>
                                    <tr>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                            <strong class="text-dark" style="width: 210px;">Pendidikan Sebelumnya</strong>
                                            <span>: &nbsp; {{ $siswa->pendidikan_sebelumnya }}</span>
                                        </li>
                                    </tr>
                                    <tr>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                            <strong class="text-dark" style="width: 210px;">Alamat</strong>
                                            <span>: &nbsp; {{ $siswa->alamat }}</span>
                                        </li>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable();
                });
            </script>
        </div>

        <br>

        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Rapor Siswa</h6>
            </div>
            <div class="card-body pt- p-3">
                <table class="table align-items-center mb-0">
                    <tbody>
                        <tr>
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                <strong class="text-dark" style="width: 150px;">Nilai Rapor</strong>
                                <span>: &nbsp; {{ $nilaiRapor }}</span>
                            </li>
                        </tr>
                        <tr>
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                <strong class="text-dark" style="width: 150px;">Status Naik Kelas</strong>
                                <span>: &nbsp; {{ $statusNaikKelas }}</span>
                            </li>
                        </tr>
                    </tbody>
                </table>

                <div class="table-responsive p-0 mt-2">
                    <table id="myTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Mata Pelajaran</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswaMataPelajaran as $index => $item)
                                <tr>
                                    <td class="text-start">{{ $index + 1 }}</td>
                                    <td class="text-start">{{ $item->mataPelajaran->nama }}</td>
                                    <td class="text-start">{{ $item->nilai_akhir }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable();
                });
            </script>
        </div>
    </div>
@endsection
