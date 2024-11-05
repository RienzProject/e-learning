@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Data Tenaga Pengajar</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/tenaga-pengajar/{{ $data->id }}" method="POST" role="form text-left">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Nama</label>
                                <input class="form-control" type="text" placeholder="Masukkan Nama" name="name"
                                    value="{{ $data->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="NIP" class="form-control-label">NIP</label>
                                <input class="form-control" type="number" placeholder="Masukkan NIP" name="NIP"
                                    value="{{ $data->NIP }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="TTL" class="form-control-label">Tempat, Tanggal Lahir</label>
                                <input class="form-control" type="text" placeholder="Masukkan Tempat, Tanggal Lahir"
                                    name="TTL" value="{{ $data->TTL }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="form-control-label">Alamat</label>
                                <input class="form-control" type="text" placeholder="Masukkan Alamat" name="alamat"
                                    value="{{ $data->alamat }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="agama" class="form-control-label">Agama</label>
                                <input class="form-control" type="text" placeholder="Masukkan Agama" name="agama"
                                    value="{{ $data->agama }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="gender" class="form-control-label">Jenis Kelamin</label>
                                <input class="form-control" type="text" placeholder="Masukkan Agama" name="gender"
                                    value="{{ $data->gender }}" readonly>
                            </div>
                        </div>
                        @if ($data->waliKelas)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kelas" class="form-control-label">Kelas</label>
                                    <input class="form-control" type="text" placeholder="Masukkan Kelas" name="kelas"
                                        value="{{ $data->waliKelas->kelas->nama }}" readonly>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="pt-3 pb-2">
                        <h6 class="mb-0">Data Akun Login</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username" class="form-control-label">Username</label>
                                <input class="form-control" type="text" value="{{ $data->username }}"
                                    placeholder="Masukkan Username Untuk Login" name="username" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="form-control-label">Ubah Password</label>
                                <input class="form-control" type="password" placeholder="Tidak Ditampilkan"
                                    name="password" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/tenaga-pengajar" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
