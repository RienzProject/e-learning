@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Tambah Data Ekstrakulikuler</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/ekstrakulikuler" method="POST" role="form text-left">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Ekstrakulikuler <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" placeholder="Masukkan Ekstrakulikuler" name="nama" required>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hari" class="form-control-label">Hari <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="hari" name="hari" required>
                                    <option value="" disabled selected>Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jam" class="form-control-label">Jam <span class="text-danger">*</span></label>
                                <input class="form-control" type="time"  name="jam" required>
                            </div>
                        </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/ekstrakulikuler" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Tambah' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection