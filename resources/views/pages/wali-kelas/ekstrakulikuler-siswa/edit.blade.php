@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <div>
        <div class="py-1">
            <div class="card mb-4 p-3">
                <div class="text-start">
                    <a href="/ekstrakulikuler-siswa/{{ $ekstrakulikuler->id }}">
                        <button type="button" class="btn bg-gradient-danger">Kembali</button>
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Nama Siswa</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Semester</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        @if ($item->kelas_semester_id == null)
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm text-danger">Belum Ditentukan</h6>
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->kelasSemester->semester->nama }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <form action="/ekstrakulikuler-siswa" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $ekstrakulikuler->id }}" name="ekstrakulikuler_id">
                                                        <input type="hidden" value="{{ $item->id }}" name="siswa_id">
                                                        <button type="submit" class="btn bg-gradient-dark">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                                            </svg>
                                                            Tambahkan ke Ekstrakulikuler {{ $ekstrakulikuler->nama }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                        <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                        <script>let table = new DataTable('#myTable');</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
