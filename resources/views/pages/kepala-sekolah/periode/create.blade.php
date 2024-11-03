@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Tambah Data Periode</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/periode" method="POST" role="form text-left">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tahun_ajaran" class="form-control-label">Tahun Ajaran <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" placeholder="Masukkan Tahun Ajaran" name="tahun_ajaran" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/kelas" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Tambah' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection