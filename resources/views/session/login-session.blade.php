@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
 
                    <div class="card-body text-center position-relative" style="z-index: 4;"> <!-- Ubah z-index menjadi 2 atau lebih besar -->
    <div class="rounded p-4 bg-light shadow" style="background-color: rgba(255, 255, 255, 0.2); border: 1px solid black; z-index: 4;"> <!-- Transparan dan garis tepi hitam -->
        <!-- Menambahkan gambar di atas -->
        <img src="../assets/img/logo-sekolah.png" alt="Logo Sekolah" class="img-fluid mb-4" style="width: 25%; height: auto; z-index: 4;">
        
        <form role="form" method="POST" action="/session">
            @csrf
            <label>Nama User</label>
            <div class="mb-3">
                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Nama User" aria-label="Username" aria-describedby="username-addon">
                @error('username')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <label>Password</label>
            <div class="mb-3 position-relative">
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" aria-label="Password" aria-describedby="password-addon">
                <span class="position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePassword()" style="cursor: pointer;">
                    <i class="fa fa-eye" id="togglePasswordIcon"></i>
                </span>
                @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
            </div>
        </form>
        
        <script>
            function togglePassword() {
                const passwordField = document.getElementById("password");
                const toggleIcon = document.getElementById("togglePasswordIcon");
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    toggleIcon.classList.remove("fa-eye");
                    toggleIcon.classList.add("fa-eye-slash");
                } else {
                    passwordField.type = "password";
                    toggleIcon.classList.remove("fa-eye-slash");
                    toggleIcon.classList.add("fa-eye");
                }
            }
        </script>
    </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
 @endsection