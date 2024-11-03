@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0 fs-5 text-info fw-bold">Nilai  {{ $data->mataPelajaran->nama }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <input type="hidden" value="{{ $data->id }}" name="siswa_mata_pelajaran_id">
                <div class="row">
                    @foreach ($uploadTugas as $item)
                        <input type="hidden" value="{{ $item->id }}" name="upload_tugas_id[]">
                        <input type="hidden" value="{{ $data->id }}" name="siswa_id">
                        <input type="hidden" value="{{ $mataPelajaranId }}" name="mata_pelajaran_id">
                        <div class="row">
                            <div class="col-md-2 mt-1">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">{{ $item->nama_tugas }}</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    @php
                                        $nilaiItem = $nilaiMataPelajaran->where('upload_tugas_id', $item->id)->first();
                                    @endphp
                                    @if ($nilaiItem && $nilaiItem->nilai)
                                        <input class="form-control" value="{{ $nilaiItem->nilai }}" type="text"
                                            placeholder="Masukkan Nilai" name="nilai_{{ $item->id }}" readonly>
                                    @else
                                        <input class="form-control" type="text" placeholder="Masukkan Nilai"
                                            name="nilai_{{ $item->id }}" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
