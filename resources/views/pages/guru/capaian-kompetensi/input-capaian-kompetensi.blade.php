@extends('layouts.user_type.guru.form')

@section('content')
    <div class="container-fluid py-2">
        <div>
            <h3 class="fw-bolder text-black text-center">CAPAIAN KOMPETENSI</h3>
        </div>
        <div class="card mt-4 mx-5 px-4 py-3">
            <div class="card-body pt-4 p-3">
                <form action="/capaian-kompetensi-guru/input-capaian-kompetensi" method="POST" role="form text-left">
                    @csrf
                    <input type="hidden" value="{{ $nilaiMataPelajaran->id }}" name="nilai_mata_pelajaran_id">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Nama Siswa</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal">{{ $nilaiMataPelajaran->siswaMataPelajaran->siswa->nama }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Mata Pelajaran</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal">{{ $nilaiMataPelajaran->siswaMataPelajaran->mataPelajaran->nama }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Nilai Akhir</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal">{{ $nilaiMataPelajaran->nilai }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2 mt-1">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Capaian Kompetensi</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="catatan" cols="30" rows="5" placeholder="Tulis Capaian Kompetensi..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/capaian-kompetensi-guru/{{ $nilaiMataPelajaran->siswaMataPelajaran->siswa_id }}"
                            class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Tambah' }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="py-1 mt-5">
            <div class="card mb-4 p-3">
                <div class="card-body px-0 pt-0 pb-2 mt-3">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                    <th class="text-uppercase text-xs font-weight-bolder text-center">Catatan Capaian
                                        Kompetensi</th>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($capaianKompetensi as $index => $item)
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
                                                    <h6 class="mb-0 text-sm" title="{{ $item->catatan }}">
                                                        {{ strlen($item->catatan) > 100 ? substr($item->catatan, 0, 150) . '...' : $item->catatan }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="/capaian-kompetensi-guru/{{ $item->id }}/show-capaian-kompetensi">
                                                        <button type="button" class="btn bg-gradient-warning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-back"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                                                            </svg>
                                                            Detail
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="ms-2 d-flex flex-column justify-content-center">
                                                    <form action="/capaian-kompetensi-guru/{{ $item->id }}" method="POST"
                                                        role="form text-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" value="{{ $nilaiMataPelajaran->id }}" name="nilai_mata_pelajaran_id">
                                                        <button type="submit" class="btn bg-gradient-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-trash3 mb-1"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
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
            </div>
        </div>
    </div>
@endsection
