@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0 fs-4">Tambah Data Siswa</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/identitas-siswa" method="POST" role="form text-left">
                    @csrf
                    <h6 class="text-info fw-bold fs-5">Identitas Siswa</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NIS" class="form-control-label">NIS <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="number" placeholder="Masukkan NIS" name="NIS"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NISN" class="form-control-label">NISN <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="number" placeholder="Masukkan NISN"
                                    name="NISN" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="form-control-label">Nama Siswa <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Nama Siswa" name="nama"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-control-label">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <select name="jenis_kelamin" id="" class="form-select">
                                    <option value="0" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir" class="form-control-label">Tempat Lahir <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Tempat Lahir"
                                    name="tempat_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-control-label">Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="date" placeholder="Masukkan Tanggal Lahir"
                                    name="tanggal_lahir" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="agama" class="form-control-label">Agama <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="agama" name="agama" required>
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pendidikan_sebelumnya" class="form-control-label">Pendidikan Sebelumnya <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Pendidikan Sebelumnya"
                                    name="pendidikan_sebelumnya" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat" class="form-control-label">Alamat Siswa <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Alamat Siswa"
                                    name="alamat" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kelas_id" class="form-control-label">Kelas <span
                                        class="text-danger">*</span></label>
                                <select name="kelas_id" id="" class="form-select">
                                    <option value="0" selected disabled>Pilih Kelas</option>
                                    @foreach ($kelasSemester as $item)
                                        <option value="{{ $item->id }}">{{ $item->kelas->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-info fw-bold fs-5 mt-4">Data Orang Tua</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ayah" class="form-control-label">Nama Ayah <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Nama Ayah"
                                    name="nama_ayah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ibu" class="form-control-label">Nama Ibu <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Nama Ibu"
                                    name="nama_ibu" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ayah" class="form-control-label">Pekerjaan Ayah <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Pekerjaan Ayah"
                                    name="pekerjaan_ayah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ibu" class="form-control-label">Pekerjaan Ibu <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Pekerjaan Ibu"
                                    name="pekerjaan_ibu" required>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-info fw-bold fs-5 mt-4">Alamat Orang Tua</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jalan" class="form-control-label">Jalan <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Jalan" name="jalan"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelurahan" class="form-control-label">Kelurahan <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Kelurahan"
                                    name="kelurahan" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan" class="form-control-label">Kecamatan <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Kecamatan"
                                    name="kecamatan" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kota" class="form-control-label">Kota <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Kota" name="kota"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provinsi" class="form-control-label">Provinsi <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Pekerjaan Ibu"
                                    name="provinsi" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/identitas-siswa" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Tambah' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
