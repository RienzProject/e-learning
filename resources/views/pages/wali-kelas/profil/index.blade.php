@extends('layouts.user_type.wali-kelas.auth')

@section('content')
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <div class="card card-body blur shadow-blur mx-4 overflow-hidden mt-2">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        @if ($user->foto)
                            <img src="{{ asset('storage/foto/' . $user->foto) }}" alt="profile_image"
                                class="w-100 h-125 border-radius-lg shadow-sm mt-3">
                        @else
                            <img src="../assets/img/bruce-mars.jpg" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $user->role }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-3">
                <form action="/upload-foto" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="foto">Upload Foto Profil</label>
                        <input type="file" class="form-control" accept=".png, .jpg, .jpeg" name="foto" id="foto">
                        <small class="mt-2 ms-2 text-danger">Catatan : Upload foto maksimal 2 MB</small>
                    </div>
                    <button type="submit" class="btn btn-dark">Upload Foto</button>
                </form>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="px-2 py-2">
                            <div class="card-header pb-0 p-3">
                                <h5 class="mb-1 font-bolder">Biodata</h5>
                            </div>
                            <div class="card-body px-3 py-2">
                                <div class="row">
                                    <!-- Kolom pertama -->
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm biodata-item d-flex">
                                                <strong class="text-dark" style="width: 150px;">Nama Lengkap</strong>
                                                <span>: &nbsp; {{ $user->name }}</span>
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm biodata-item d-flex">
                                                <strong class="text-dark" style="width: 150px;">NIP</strong>
                                                <span>: &nbsp; {{ $user->NIP }}</span>
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm biodata-item d-flex">
                                                <strong class="text-dark" style="width: 150px;">Tempat, Tanggal
                                                    Lahir</strong>
                                                <span>: &nbsp; {{ $user->tempat_lahir }},
                                                    {{ \Carbon\Carbon::parse($user->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Kolom kedua -->
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 ps-0 text-sm biodata-item d-flex">
                                                <strong class="text-dark" style="width: 150px;">Alamat</strong>
                                                <span>: &nbsp; {{ $user->alamat }}</span>
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm biodata-item d-flex">
                                                <strong class="text-dark" style="width: 150px;">Agama</strong>
                                                <span>: &nbsp; {{ $user->agama }}</span>
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm biodata-item d-flex">
                                                <strong class="text-dark" style="width: 150px;">Gender</strong>
                                                <span>: &nbsp; {{ $user->gender }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="px-2 py-2">
                            <div class="card-header pb-0 p-3">
                                <h5 class="mb-1 font-bolder">Ubah Password Akun</h5>
                            </div>
                            <div class="card-body px-3 py-2">
                                <form action="/ubah-password" method="POST" role="form text-left">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password_lama" class="form-control-label">Password Lama <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="password"
                                                    placeholder="Masukkan Password Lama" name="password_lama" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password_baru" class="form-control-label">Password Baru <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="password"
                                                    placeholder="Masukkan Password Baru" name="password_baru" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="konfirmasi_password_baru" class="form-control-label">Konfirmasi
                                                    Password <span class="text-danger">*</span></label>
                                                <input class="form-control" type="password"
                                                    placeholder="Ketik Ulang Password Baru" name="konfirmasi_password_baru"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Ubah Password' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Aksi Dihentikan',
            text: '{{ session('error') }}',
        });
    </script>
    @elseif
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Pemberitahuan',
            text: '{{ session('success') }}',
        });
    </script>
    @endif
@endsection
