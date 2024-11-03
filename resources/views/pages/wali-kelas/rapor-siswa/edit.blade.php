@extends('layouts.user_type.wali-kelas.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Edit Data Kelas</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/kelas/{{ $data->id }}" method="POST" role="form text-left">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Nama Kelas <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="{{ $data->nama }}" placeholder="Masukkan Nama Kelas" name="nama" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/kelas" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection