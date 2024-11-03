@extends('layouts.user_type.wali-kelas.auth')

@section('content')
    <div>
        <div class="py-1">
            <div class="card mb-4 p-3">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Nama Siswa</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Tentukan Kenaikan Kelas Siswa</th>
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
                                                <form id="formLulus{{ $item->id }}"
                                                    action="/kenaikan-kelas/{{ $item->id }}" method="POST"
                                                    role="form text-left" class="me-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="lulus" value="1">
                                                    <input type="hidden" name="kelas_semester_id"
                                                        id="kelas_semester_id{{ $item->id }}" value="">
                                                    <button type="button" class="btn bg-gradient-info"
                                                        onclick="showLulusModal('{{ $item->id }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-arrow-up mb-1"
                                                            viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
                                                        </svg>
                                                        Lulus
                                                    </button>
                                                </form>

                                                <form id="formTidakLulus{{ $item->id }}"
                                                    action="/kenaikan-kelas/{{ $item->id }}" method="POST"
                                                    role="form text-left">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="tidak_lulus" value="1">
                                                    <button type="button" class="btn bg-gradient-danger"
                                                        onclick="showTidakLulusModal('{{ $item->id }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-arrow-down mb-1"
                                                            viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v12.793l3.146-3.147a.5.5 0 1 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 1 1 .708-.708L7.5 14.293V1.5A.5.5 0 0 1 8 1z" />
                                                        </svg>
                                                        Tidak Lulus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const kelasSemesterData = @json(
            $kelasSemester->mapWithKeys(function ($item) {
                return [$item->id => 'Kelas ' . $item->kelas->nama . ' - ' . 'Semester ' . $item->semester->nama];
            }));

        function showLulusModal(itemId) {
            Swal.fire({
                title: "Pilih Kenaikan Kelas",
                input: "select",
                inputOptions: kelasSemesterData,
                inputPlaceholder: "Pilih kelas dan semester",
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value !== "") {
                            resolve();
                        } else {
                            resolve("Anda harus memilih salah satu opsi");
                        }
                    });
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    document.getElementById(`kelas_semester_id${itemId}`).value = result.value;
                    document.getElementById(`formLulus${itemId}`).submit();
                }
            });
        }

        function showTidakLulusModal(itemId) {
            Swal.fire({
                title: 'Siswa Tidak Lulus',
                text: "Siswa akan melanjutkan ke kelas yang sama tahun ini",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, lanjutkan',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`formTidakLulus${itemId}`).submit();
                }
            });
        }
    </script>
@endsection
