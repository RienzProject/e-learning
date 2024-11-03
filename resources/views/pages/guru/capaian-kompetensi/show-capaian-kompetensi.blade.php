@extends('layouts.user_type.guru.form')

@section('content')
    <div class="container-fluid py-2">
        <div>
            <h3 class="fw-bolder text-black text-center">DETAIL CAPAIAN KOMPETENSI</h3>
        </div>
        <div class="card mt-4">
            <div class="card-body pt-4 p-3">
                <form action="">
                    <input type="hidden" value="{{ $capaianKompetensi->nilaiMataPelajaran->id }}"
                        name="nilai_mata_pelajaran_id">
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
                                        class="form-control-label fs-6 fw-normal">{{ $capaianKompetensi->nilaiMataPelajaran->siswaMataPelajaran->siswa->nama }}</label>
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
                                        class="form-control-label fs-6 fw-normal">{{ $capaianKompetensi->nilaiMataPelajaran->siswaMataPelajaran->mataPelajaran->nama }}</label>
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
                                        class="form-control-label fs-6 fw-normal">{{ $capaianKompetensi->nilaiMataPelajaran->nilai }}</label>
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
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal text-justify">{{ $capaianKompetensi->catatan }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/capaian-kompetensi-guru/{{ $capaianKompetensi->nilaiMataPelajaran->siswaMataPelajaran->siswa_id }}/input-capaian-kompetensi"
                            class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
