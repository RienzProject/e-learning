@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <div class="container-fluid py-2">
        <div>
            <h3 class="fw-bolder text-black text-center">CATATAN SISWA</h3>
        </div>
        <div class="card mt-4 mx-5 px-4 py-3">
            <div class="card-body pt-4 p-3">
                <form action="/ekstrakulikuler-siswa/input-catatan-siswa/{{ $data->id }}" method="POST" role="form text-left">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $data->siswa->id }}" name="siswa_id">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Nama Siswa</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal">{{ $data->siswa->nama }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Ekstrakulikuler</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal">{{ $data->ekstrakulikuler->nama }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Predikat</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <select name="predikat" id="" class="form-select">
                                        <option value="0" selected disabled>Pilih Predikat</option>
                                        <option value="Berkembang" {{ $data->predikat === 'Berkembang' ? 'selected' : '' }}>Berkembang</option>
                                        <option value="Tidak Berkembang" {{ $data->predikat === 'Tidak Berkembang' ? 'selected' : '' }}>Tidak Berkembang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="row">
                            <div class="col-md-2 mt-1">
                                <div class="form-group">
                                    <label for="keterangan" class="form-control-label fs-6">Keterangan</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="keterangan" cols="30" rows="5" placeholder="Tulis Keterangan...">{{ $data->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/ekstrakulikuler-siswa/{{ $data->ekstrakulikuler->id }}"
                            class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
