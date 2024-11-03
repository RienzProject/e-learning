@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
    <div>
        <div class="py-1">
            <div class="card mb-4 p-3">
                <div class="py-2 px-1">
                    <h6 class="mb-0 fs-5"></h6>
                    <h6 class="mb-0 fs-5">Siswa Kelas {{ $kelasSemester->kelas->nama }}</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Nama Siswa</th>
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
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="/validasi-rapor/check-rapor-pdf/{{ $item->id }}"
                                                        target="_blank">
                                                        <button type="button" class="btn bg-gradient-dark">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-back me-1 mb-1" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                                                            </svg>
                                                            CEK RAPOR
                                                        </button>
                                                    </a>
                                                </div>

                                                <div class="ms-2 d-flex flex-column justify-content-center">
                                                    <form id="validasi-rapor-{{ $item->id }}"
                                                        action="{{ route('validasi-rapor.update', $item->id) }}"
                                                        method="POST" role="form text-left"
                                                        onsubmit="event.preventDefault(); validasiRapor({{ $item->id }})">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn bg-gradient-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                                                <path
                                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                                                <path
                                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                                            </svg>
                                                            Validasi Rapor
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                        <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                        <script>
                            let table = new DataTable('#myTable');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function validasiRapor(id) {
            Swal.fire({
                title: "Validasi Rapor",
                text: "Apakah rapor siswa sudah benar dan siap diunduh? Melakukan validasi 2x kemungkinan akan menyebabkan pengaruh pada file rapor!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, lanjutkan"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('validasi-rapor-' + id).submit();
                }
            });
        }
    </script>
@endsection
