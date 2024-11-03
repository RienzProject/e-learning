@extends('layouts.user_type.wali-kelas.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Edit Tugas</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/upload-tugas/{{ $data->id }}" method="POST" role="form text-left" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mata_pelajaran_id" class="form-control-label">Mata Pelajaran</label>
                            <select name="mata_pelajaran_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Mata Pelajaran</option>
                                @foreach ($mataPelajaran as $item)
                                    <option value="{{ $item->id }}" {{ $data && $data->mata_pelajaran_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_tugas" class="form-control-label">Nama Tugas</label>
                            <input class="form-control" type="text" value="{{ $data->nama_tugas }}" placeholder="Masukkan Nama Tugas" name="nama_tugas">
                        </div>
                        <div class="form-group">
                            <label for="upload_tugas" class="form-control-label">Upload Tugas</label>
                            <input class="form-control" type="file" accept=".pdf, .doc" name="upload_tugas">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/upload-tugas" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection