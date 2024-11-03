@extends('layouts.user_type.wali-kelas.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Edit Data Mata Pelajaran</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/mata-pelajaran/{{ $data->id }}" method="POST" role="form text-left">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="semester_id" class="form-control-label">Semester</label>
                            <select name="semester_id" id="" class="form-select">
                                @foreach ($semester as $item)
                                    <option value="{{ $item->id }}" {{ $data && $data->kelas_semester_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->semester->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id" class="form-control-label">Pengajar</label>
                            <select name="user_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Pengajar</option>
                                @foreach ($pengajar as $item)
                                    <option value="{{ $item->id }}" {{ $data && $data->user_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} - {{ $item->role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id" class="form-control-label">Kategori</label>
                            <select name="kategori_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Kategori Pelajaran</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" {{ $data && $data->kategori_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Mata Pelajaran</label>
                            <input class="form-control" value="{{ $data->nama }}" type="text" placeholder="Masukkan Mata Pelajaran" name="nama" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/mata-pelajaran" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection