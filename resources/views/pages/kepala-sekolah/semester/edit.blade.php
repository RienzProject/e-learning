@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
    <div class="container-fluid py-4 mt-5">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Edit Data Semester</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/semester/{{ $data->id }}" method="POST" role="form text-left">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="form-group flex-grow-1 me-2">
                                <label for="awal_tahun_ajaran" class="form-control-label">Awal Tahun Ajaran <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Awal Tahun Ajaran"
                                    value="{{ $data->semester->awal_tahun_ajaran }}" name="awal_tahun_ajaran" required>
                            </div>
                            <h3 class="mt-3 ms-3 me-3">/</h3>
                            <div class="form-group flex-grow-1 ms-2">
                                <label for="akhir_tahun_ajaran" class="form-control-label">Akhir Tahun Ajaran <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Akhir Tahun Ajaran"
                                    value="{{ $data->semester->akhir_tahun_ajaran }}" name="akhir_tahun_ajaran" required>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="form-group flex-grow-1 me-2">
                                <label for="tanggal_mulai" class="form-control-label">Tanggal Mulai <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="date" placeholder="Masukkan Tanggal Mulai"
                                    value="{{ $data->semester->tanggal_mulai }}" name="tanggal_mulai" required>
                            </div>
                            <h3 class="mt-3 ms-3 me-3">-</h3>
                            <div class="form-group flex-grow-1 ms-2">
                                <label for="tanggal_akhir" class="form-control-label">Tanggal Akhir <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="date" placeholder="Masukkan Tanggal Mulai"
                                    value="{{ $data->semester->tanggal_akhir }}" name="tanggal_akhir" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama_kelas" class="form-control-label">Kelas</label>
                                <input type="hidden" name="kelas_id" value="{{ $data->kelas->id }}">
                                <input class="form-control" type="text" value="{{ $data->kelas->nama }}"
                                    placeholder="Masukkan Semester" name="nama_kelas" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="form-control-label">Semester <span
                                        class="text-danger">*</span></label>
                                <select name="nama" id="" class="form-select">
                                    <option value="0" selected disabled>Pilih Semester</option>
                                    <option value="Gasal" {{ $data->semester->nama === 'Gasal' ? 'selected' : '' }}>Gasal
                                    </option>
                                    <option value="Genap" {{ $data->semester->nama === 'Genap' ? 'selected' : '' }}>Genap
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/semester" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
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
