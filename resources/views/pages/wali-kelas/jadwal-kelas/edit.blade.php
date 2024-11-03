@extends('layouts.user_type.wali-kelas.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Edit Data Mata Pelajaran</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/jadwal-kelas/{{ $data->id }}" method="POST" role="form text-left">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="hari" class="form-control-label">Hari <span class="text-danger">*</span></label>
                            <select name="hari" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Hari</option>
                                <option value="Senin" {{ $data->hari === 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ $data->hari === 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ $data->hari === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ $data->hari === 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ $data->hari === "Jumat" ? 'selected' : '' }}>Jumat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hari" class="form-control-label">Mata Pelajaran <span class="text-danger">*</span></label>
                            <select name="mata_pelajaran_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Mata Pelajaran</option>
                                @foreach ($mataPelajaran as $item)
                                    <option value="{{ $item->id }}" {{ $data && $data->mata_pelajaran_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/jadwal-kelas" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection