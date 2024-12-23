@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Tambah Data Tenaga Pengajar</h6>
            </div>
            <div class="card-body pt-2 p-3 mt-3">
                <form action="/tenaga-pengajar" method="POST" role="form text-left">
                    @csrf
                    <input type="hidden" name="role" id="hidden-role">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Nama <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Nama" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NIP" class="form-control-label">NIP <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="number" min="0" placeholder="Masukkan NIP"
                                    name="NIP" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir" class="form-control-label">Tempat Lahir <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Tempat Lahir"
                                    name="tempat_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-control-label">Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="date" placeholder="Masukkan Tanggal Lahir"
                                    name="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat" class="form-control-label">Alamat <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Alamat" name="alamat"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agama" class="form-control-label">Agama <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="agama" name="agama" required>
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="form-control-label">Jabatan <span
                                        class="text-danger">*</span></label>
                                <select id="role-select" class="form-select" name="role" required>
                                    <option value="" selected disabled>Pilih Jabatan</option>
                                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                                    <option value="Wali Kelas">Wali Kelas</option>
                                    <option value="Guru">Guru</option>
                                </select>
                            </div>
                        </div>
                        <!-- Input Kelas untuk Wali Kelas -->
                        <div class="col-md-6" id="kelas-section" style="display: none;">
                            <div class="form-group">
                                <label for="kelas_id" class="form-control-label">Kelas <span
                                        class="text-danger">*</span></label>
                                <select name="kelas_id" class="form-select">
                                    <option value="" selected disabled>Pilih Kelas</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Input Kelas untuk Guru -->
                        <div class="col-md-6" id="checkbox-kelas-section" style="display: none;">
                            <div class="form-group">
                                <label class="form-control-label">Pilih Kelas <span class="text-danger">*</span></label>
                                <div>
                                    @foreach ($kelas as $item)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="kelas_id[]"
                                                value="{{ $item->id }}">
                                            <label class="form-check-label">{{ $item->nama }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jenisKelaminLaki" name="gender"
                                        value="Laki-Laki" required>
                                    <label class="form-check-label" for="jenisKelaminLaki">Laki-Laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jenisKelaminPerempuan"
                                        name="gender" value="Perempuan">
                                    <label class="form-check-label" for="jenisKelaminPerempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 pb-2">
                        <h6 class="mb-0">Data Akun Login</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username" class="form-control-label">Username <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Masukkan Username Untuk Login"
                                    name="username" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="password" placeholder="Masukkan Password"
                                    name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/tenaga-pengajar" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('role-select').addEventListener('change', function() {
            const selectedRole = this.value;
            const kelasSection = document.getElementById('kelas-section');
            const checkboxKelasSection = document.getElementById('checkbox-kelas-section');

            // Sembunyikan semua input kelas
            kelasSection.style.display = 'none';
            checkboxKelasSection.style.display = 'none';

            // Tampilkan input sesuai pilihan
            if (selectedRole === 'Wali Kelas') {
                kelasSection.style.display = 'block';
            } else if (selectedRole === 'Guru') {
                checkboxKelasSection.style.display = 'block';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Aksi Dihentikan',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endsection
