@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Edit Data Siswa</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/identitas-siswa/{{ $data->id }}" method="POST" role="form text-left">
                    @method('PUT')
                    @csrf
                    <h6 class="text-info fw-bold fs-5">Identitas Siswa</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NIS" class="form-control-label">NIS</label>
                                <input class="form-control" type="text" value="{{ $data->NIS }}"
                                    placeholder="Masukkan NIS" name="NIS">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NISN" class="form-control-label">NISN</label>
                                <input class="form-control" type="text" max="10" value="{{ $data->NISN }}"
                                    placeholder="Masukkan NISN" name="NISN">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="form-control-label">Nama Siswa</label>
                                <input class="form-control" type="text" value="{{ $data->nama }}"
                                    placeholder="Masukkan Nama Siswa" name="nama">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                    <option value="0" disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki" {{ $data->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan" {{ $data->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir" class="form-control-label">Tempat Lahir</label>
                                <input class="form-control" value="{{ $data->tempat_lahir }}" type="text"
                                    placeholder="Masukkan Tempat Lahir" name="tempat_lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-control-label">Tanggal Lahir</label>
                                <input class="form-control" value="{{ $data->tanggal_lahir }}" type="date"
                                    placeholder="Masukkan Tanggal Lahir" name="tanggal_lahir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="agama" class="form-control-label">Agama <span
                                        class="text-danger">*</span></label>
                                <select name="agama" id="" class="form-select">
                                    <option value="0" selected disabled>Pilih Agama</option>
                                    <option value="Islam" {{ $data->agama === 'Islam' ? 'selected' : '' }}>Islam
                                    </option>
                                    <option value="Kristen" {{ $data->agama === 'Kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="Katolik" {{ $data->agama === 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Hindu" {{ $data->agama === 'Hindu' ? 'selected' : '' }}>Hindu
                                    </option>
                                    <option value="Buddha" {{ $data->agama === 'Buddha' ? 'selected' : '' }}>Buddha
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pendidikan_sebelumnya" class="form-control-label">Pendidikan Sebelumnya</label>
                                <input class="form-control" value="{{ $data->pendidikan_sebelumnya }}" type="text"
                                    placeholder="Masukkan Pendidikan Sebelumnya" name="pendidikan_sebelumnya">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat" class="form-control-label">Alamat Siswa</label>
                                <input class="form-control" value="{{ $data->alamat }}" type="text"
                                    placeholder="Masukkan Alamat Siswa" name="alamat">
                            </div>
                        </div>
                    </div>
                    <h6 class="text-info fw-bold fs-5 mt-4">Data Orang Tua</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ayah" class="form-control-label">Nama Ayah</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->nama_ayah }}" type="text"
                                    placeholder="Masukkan Nama Ayah" name="nama_ayah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ibu" class="form-control-label">Nama Ibu</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->nama_ibu }}" type="text"
                                    placeholder="Masukkan Nama Ibu" name="nama_ibu">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ayah" class="form-control-label">Pekerjaan Ayah</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->pekerjaan_ayah }}"
                                    type="text" placeholder="Masukkan Pekerjaan Ayah" name="pekerjaan_ayah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ibu" class="form-control-label">Pekerjaan Ibu</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->pekerjaan_ibu }}"
                                    type="text" placeholder="Masukkan Pekerjaan Ibu" name="pekerjaan_ibu">
                            </div>
                        </div>
                    </div>
                    <h6 class="text-info fw-bold fs-5 mt-4">Alamat Orang Tua</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jalan" class="form-control-label">Jalan</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->jalan }}" type="text"
                                    placeholder="Masukkan Jalan" name="jalan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelurahan" class="form-control-label">Kelurahan</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->kelurahan }}" type="text"
                                    placeholder="Masukkan Kelurahan" name="kelurahan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan" class="form-control-label">Kecamatan</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->kecamatan }}" type="text"
                                    placeholder="Masukkan Kecamatan" name="kecamatan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kota" class="form-control-label">Kota</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->kota }}" type="text"
                                    placeholder="Masukkan Kota" name="kota">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provinsi" class="form-control-label">Provinsi</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->provinsi }}" type="text"
                                    placeholder="Masukkan Pekerjaan Ibu" name="provinsi">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/identitas-siswa" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
