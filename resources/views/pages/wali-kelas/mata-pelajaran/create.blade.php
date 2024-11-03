@extends('layouts.user_type.wali-kelas.form')

@section('content')
<div class="container-fluid py-4 mt-8">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Tambah Data Mata Pelajaran</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/mata-pelajaran" method="POST" role="form text-left">
                @csrf
                @foreach ($siswa as $item) 
                    <input type="hidden" name="siswa_id[]" value="{{ $item->id }}">
                @endforeach
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="semester_id" class="form-control-label">Semester <span class="text-danger">*</span></label>
                            <select name="semester_id" id="" class="form-select">
                                @foreach ($semester as $item)
                                    <option value="{{ $item->id }}">{{ $item->semester->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id" class="form-control-label">Pengajar <span class="text-danger">*</span></label>
                            <select name="user_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Pengajar</option>
                                @foreach ($pengajar as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id" class="form-control-label">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Kategori Pelajaran</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Mata Pelajaran <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" placeholder="Masukkan Mata Pelajaran" name="nama" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/mata-pelajaran" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Tambah' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection