@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Tambah Data Mata Pelajaran</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/mata-pelajaran" method="POST" role="form text-left">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kode" class="form-control-label">Kode Mata Pelajaran <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Kode Mata Pelajaran"
                                    name="kode" required>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="form-control-label">Mata Pelajaran <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Mata Pelajaran"
                                    name="nama" required>
                            </div>
                            <div class="form-group">
                                <label>Pilih Jenis Mata Pelajaran:</label>
                                <div class="form-check">
                                    <input type="radio" name="jenis" value="Mata Pelajaran" id="mataPelajaran" class="form-check-input">
                                    <label for="mataPelajaran" class="form-check-label">Mata Pelajaran</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="jenis" value="Muatan Pelajaran" id="muatanPelajaran" class="form-check-input">
                                    <label for="muatanPelajaran" class="form-check-label">Muatan Pelajaran</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_id" class="form-control-label">Guru Pengampu <span class="text-danger">*</span></label>
                                @foreach ($guruPengampu as $item)
                                    <div class="form-check">
                                        <input class="form-check-input guru-checkbox" type="checkbox" name="user_id[]"
                                            value="{{ $item->id }}" id="guru{{ $item->id }}" data-role="{{ $item->role }}" data-id="{{ $item->id }}">
                                        <label class="form-check-label" for="guru{{ $item->id }}">
                                            {{ $item->name }} - @if ($item->role == 'Wali Kelas')
                                                Kelas {{ $item->waliKelas->kelas->nama }}
                                            @else
                                                {{ $item->role }}
                                            @endif
                                        </label>
                                    </div>
                            
                                    @if($item->role == 'Guru')
                                        <div class="form-group kelas-container" id="kelas-container-{{ $item->id }}" style="display: none;">
                                            <label for="kelas_{{ $item->id }}">Pilih Kelas:</label>
                                            @foreach ($semuaKelas as $kelas)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="kelas_{{ $item->id }}[]"
                                                           value="{{ $kelas->id }}" id="kelas_{{ $kelas->id }}_{{ $item->id }}">
                                                    <label class="form-check-label" for="kelas_{{ $kelas->id }}_{{ $item->id }}">
                                                        {{ $kelas->nama }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.guru-checkbox').forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    var role = this.getAttribute('data-role');
                    var id = this.getAttribute('data-id');
                    var kelasContainer = document.getElementById('kelas-container-' + id);
    
                    if (role === 'Guru') {
                        if (this.checked) {
                            kelasContainer.style.display = 'block';
                        } else {
                            kelasContainer.style.display = 'none';
                        }
                    }
                });
            });
        });
    </script>
@endsection
