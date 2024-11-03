@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
    <div class="container-fluid py-4 mt-5">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Tambah Data Semester</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/semester" method="POST" role="form text-left">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="form-group flex-grow-1 me-2">
                                <label for="awal_tahun_ajaran" class="form-control-label">Awal Tahun Ajaran <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Awal Tahun Ajaran"
                                    name="awal_tahun_ajaran" required>
                            </div>
                            <h3 class="mt-3 ms-3 me-3">/</h3>
                            <div class="form-group flex-grow-1 ms-2">
                                <label for="akhir_tahun_ajaran" class="form-control-label">Akhir Tahun Ajaran <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Akhir Tahun Ajaran"
                                    name="akhir_tahun_ajaran" required>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="form-group flex-grow-1 me-2">
                                <label for="tanggal_mulai" class="form-control-label">Tanggal Mulai <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="date" placeholder="Masukkan Tanggal Mulai"
                                name="tanggal_mulai" required>
                            </div>
                            <h3 class="mt-3 ms-3 me-3">-</h3>
                            <div class="form-group flex-grow-1 ms-2">
                                <label for="tanggal_akhir" class="form-control-label">Tanggal Akhir <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="date" placeholder="Masukkan Tanggal Mulai"
                                name="tanggal_akhir" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama" class="form-control-label">Semester <span
                                        class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input nama-checkbox" type="checkbox" name="nama[]"
                                        value="Gasal" checked>
                                    <label class="form-check-label" for="nama">
                                        Gasal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input nama-checkbox" type="checkbox" name="nama[]"
                                        value="Genap" checked>
                                    <label class="form-check-label" for="nama">
                                        Genap
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kelas_id" class="form-control-label">Kelas <span
                                        class="text-danger">*</span></label>
                                @foreach ($kelas as $item)
                                    <div class="form-check">
                                        <input class="form-check-input kelas-checkbox" type="checkbox" name="kelas_id[]"
                                            value="{{ $item->id }}" id="kelas{{ $item->id }}"
                                            data-id="{{ $item->id }}" checked>
                                        <label class="form-check-label" for="kelas{{ $item->id }}">
                                            {{ $item->nama }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/semester" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Tambah' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Aksi Dihentikan',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endsection
