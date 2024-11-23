@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0 fs-4">Detail Data Siswa</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/siswa/{{ $data->id }}" method="POST" role="form text-left">
                    @method('PUT')
                    @csrf
                    <h6 class="text-info fw-bold fs-5">Identitas Siswa</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NIS" class="form-control-label">NIS</label>
                                <input class="form-control" type="text" value="{{ $data->NIS }}"
                                    placeholder="Masukkan NIS" name="NIS" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NISN" class="form-control-label">NISN</label>
                                <input class="form-control" type="text" max="10" value="{{ $data->NISN }}"
                                    placeholder="Masukkan NISN" name="NISN" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="form-control-label">Nama Siswa</label>
                                <input class="form-control" type="text" value="{{ $data->nama }}"
                                    placeholder="Masukkan Nama Siswa" name="nama" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                                <input class="form-control" type="text" value="{{ $data->jenis_kelamin }}"
                                    placeholder="Masukkan Jenis Kelamin" name="jenis_kelamin" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir" class="form-control-label">Tempat Lahir</label>
                                <input class="form-control" value="{{ $data->tempat_lahir }}" type="text"
                                    placeholder="Masukkan Tempat Lahir" name="tempat_lahir" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-control-label">Tanggal Lahir</label>
                                @php
                                    use Carbon\Carbon;
                                    Carbon::setLocale('id');
                                    $tanggalLahir = Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y');
                                @endphp
                                <input class="form-control" value="{{ $tanggalLahir }}" type="text"
                                    placeholder="Masukkan Tanggal Lahir" name="tanggal_lahir" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="agama" class="form-control-label">Agama</label>
                                <input class="form-control" value="{{ $data->agama }}" type="text"
                                    placeholder="Masukkan Agama" name="agama" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pendidikan_sebelumnya" class="form-control-label">Pendidikan Sebelumnya</label>
                                <input class="form-control" value="{{ $data->pendidikan_sebelumnya }}" type="text"
                                    placeholder="Masukkan Pendidikan Sebelumnya" name="pendidikan_sebelumnya" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat" class="form-control-label">Alamat Siswa</label>
                                <input class="form-control" value="{{ $data->alamat }}" type="text"
                                    placeholder="Masukkan Alamat Siswa" name="alamat" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="foto">Foto siswa</label>
                        <div class="form-group">
                            @if ($data->foto)
                                <img src="{{ asset('storage/foto-siswa/' . $data->foto) }}" alt="profile_image"
                                    class="border-radius-lg shadow-sm mt-3" width="150px" height="150px">
                            @else
                                <img src="../assets/img/bruce-mars.jpg" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            @endif
                        </div>
                    </div>
                    <h6 class="text-info fw-bold fs-5 mt-4">Data Orang Tua</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ayah" class="form-control-label">Nama Ayah</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->nama_ayah }}" type="text"
                                    placeholder="Masukkan Nama Ayah" name="nama_ayah" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ibu" class="form-control-label">Nama Ibu</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->nama_ibu }}" type="text"
                                    placeholder="Masukkan Nama Ibu" name="nama_ibu" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ayah" class="form-control-label">Pekerjaan Ayah</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->pekerjaan_ayah }}"
                                    type="text" placeholder="Masukkan Pekerjaan Ayah" name="pekerjaan_ayah" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ibu" class="form-control-label">Pekerjaan Ibu</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->pekerjaan_ibu }}"
                                    type="text" placeholder="Masukkan Pekerjaan Ibu" name="pekerjaan_ibu" disabled>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-info fw-bold fs-5 mt-4">Alamat Orang Tua</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jalan" class="form-control-label">Jalan</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->jalan }}" type="text"
                                    placeholder="Masukkan Jalan" name="jalan" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelurahan" class="form-control-label">Kelurahan</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->kelurahan }}" type="text"
                                    placeholder="Masukkan Kelurahan" name="kelurahan" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan" class="form-control-label">Kecamatan</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->kecamatan }}" type="text"
                                    placeholder="Masukkan Kecamatan" name="kecamatan" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kota" class="form-control-label">Kota</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->kota }}" type="text"
                                    placeholder="Masukkan Kota" name="kota" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provinsi" class="form-control-label">Provinsi</label>
                                <input class="form-control" value="{{ $data->dataOrangTua->provinsi }}" type="text"
                                    placeholder="Masukkan Pekerjaan Ibu" name="provinsi" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/siswa" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
