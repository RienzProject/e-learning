<?php

use App\Http\Controllers\CapaianKompetensiGuruController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Guru\JadwalKelasGuruController;
use App\Http\Controllers\Guru\KelolaRuangPresensiGuruController;
use App\Http\Controllers\Guru\MataPelajaranGuruController;
use App\Http\Controllers\Guru\PresensiGuruController;
use App\Http\Controllers\Guru\UploadTugasGuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\KepalaSekolah\EkstrakulikulerController;
use App\Http\Controllers\KepalaSekolah\IdentitasSiswaController;
use App\Http\Controllers\KepalaSekolah\KelasController;
use App\Http\Controllers\KepalaSekolah\MataPelajaranController;
use App\Http\Controllers\KepalaSekolah\SemesterController;
use App\Http\Controllers\KepalaSekolah\TenagaPengajarController;
use App\Http\Controllers\KepalaSekolah\ProfilKepalaSekolahController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\WaliKelas\CapaianKompetensiController;
use App\Http\Controllers\WaliKelas\EkstrakulikulerSiswaController;
use App\Http\Controllers\WaliKelas\JadwalKelasController;
use App\Http\Controllers\WaliKelas\KelolaRuangPresensiController;
use App\Http\Controllers\WaliKelas\KenaikanKelasController;
use App\Http\Controllers\WaliKelas\NilaiSiswaController;
use App\Http\Controllers\WaliKelas\PresensiController;
use App\Http\Controllers\WaliKelas\ProfilController;
use App\Http\Controllers\WaliKelas\RaporSiswaController;
use App\Http\Controllers\WaliKelas\SiswaController;
use App\Http\Controllers\WaliKelas\UploadTugasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
	// Kepala Sekolah
	Route::group(['middleware' => 'role:Kepala Sekolah'], function () {
		Route::get('dashboard-kepala-sekolah', function () {
			return view('pages.kepala-sekolah.dashboard-kepala-sekolah');
		})->name('dashboard-kepala-sekolah');

		Route::get('/profil-kepala-sekolah', [ProfilKepalaSekolahController::class, 'index']);
		Route::post('/upload-foto-kepala-sekolah', [ProfilKepalaSekolahController::class, 'uploadFoto']);
		Route::post('/ubah-password-kepala-sekolah', [ProfilKepalaSekolahController::class, 'ubahPassword']);

		Route::resource('/kelas', KelasController::class);
		Route::resource('/semester', SemesterController::class);
		Route::put('/semester/{id}/ubah-status', [SemesterController::class, 'ubahStatus']);
		Route::resource('/tenaga-pengajar', TenagaPengajarController::class);
		Route::resource('/identitas-siswa', IdentitasSiswaController::class);
		Route::resource('/mata-pelajaran', MataPelajaranController::class);
		Route::resource('/ekstrakulikuler', EkstrakulikulerController::class);

		Route::get('/user-profile', [InfoUserController::class, 'create']);
		Route::post('/user-profile', [InfoUserController::class, 'store']);
		Route::get('/login', function () {
			return view('dashboard');
		})->name('sign-up');
	});

	// ---WaliKelas
	Route::group(['middleware' => 'role:Wali Kelas'], function () {
		Route::get('/', [HomeController::class, 'home']);
		Route::get('dashboard-wali-kelas', function () {
			return view('pages.wali-kelas.dashboard-wali-kelas');
		})->name('dashboard-wali-kelas');

		Route::get('/profil', [ProfilController::class, 'index']);
		Route::post('/upload-foto', [ProfilController::class, 'uploadFoto']);
		Route::post('/ubah-password', [ProfilController::class, 'ubahPassword']);

		Route::resource('/siswa', SiswaController::class);
		Route::put('/siswa/{id}/tambah-siswa', [SiswaController::class, 'tambahSiswa']);

		Route::resource('/nilai-siswa', NilaiSiswaController::class);
        Route::get('/nilai-siswa/{id}/input-nilai', [NilaiSiswaController::class, 'pageInputNilai']);
        Route::post('/nilai-siswa/input-nilai', [NilaiSiswaController::class, 'inputNilaiStore']);

		Route::resource('/ekstrakulikuler-siswa', EkstrakulikulerSiswaController::class);
		Route::get('/ekstrakulikuler-siswa/{id}/input-catatan-siswa', [EkstrakulikulerSiswaController::class, 'pageCatatanSiswa'])->name('page-input-catatan-siswa');
		Route::put('/ekstrakulikuler-siswa/input-catatan-siswa/{id}', [EkstrakulikulerSiswaController::class, 'inputCatatanSiswa'])->name('inputCatatanSiswaStore');

		// Route::resource('/mata-pelajaran', MataPelajaranController::class);
		// Route::get('/mata-pelajaran/{id}/input-nilai', [MataPelajaranController::class, 'pageInputNilai']);
		Route::post('/mata-pelajaran/input-nilai', [MataPelajaranController::class, 'inputNilaiStore']);

		Route::resource('/jadwal-kelas', JadwalKelasController::class);
		Route::resource('/kelola-ruang-presensi', KelolaRuangPresensiController::class);
		Route::resource('/presensi', PresensiController::class);

		Route::resource('/upload-tugas', UploadTugasController::class);
		Route::post('/upload-tugas/{id}/unduh-tugas', [UploadTugasController::class, 'unduhTugas']);

		Route::resource('/capaian-kompetensi', CapaianKompetensiController::class);
		Route::get('/capaian-kompetensi/{id}/input-capaian-kompetensi', [CapaianKompetensiController::class, 'pageCapaianKompetensi'])->name('page-input-capaian-kompetensi');
		Route::post('/capaian-kompetensi/input-capaian-kompetensi', [CapaianKompetensiController::class, 'inputCapaianKompetensiStore']);
		Route::get('/capaian-kompetensi/{id}/show-capaian-kompetensi', [CapaianKompetensiController::class, 'pageShowCapaianKompetensi']);

		Route::resource('/kenaikan-kelas', KenaikanKelasController::class);

		Route::resource('/rapor-siswa', RaporSiswaController::class);
        Route::get('/rapor-siswa/{id}/input-rapor', [RaporSiswaController::class, 'pageInputRapor']);
		Route::post('/rapor-siswa/unduh-rapor/{id}', [RaporSiswaController::class, 'unduhRapor']);
	});

	Route::group(['middleware' => 'role:Guru'], function () {
		Route::get('/mata-pelajaran-guru', [MataPelajaranGuruController::class, 'index'])->name('mata-pelajaran-guru');
		Route::get('/mata-pelajaran-guru/create', [MataPelajaranGuruController::class, 'create']);
		Route::post('/mata-pelajaran-guru', [MataPelajaranGuruController::class, 'store']);
		Route::get('/mata-pelajaran-guru/{id}', [MataPelajaranGuruController::class, 'show'])->name('mata-pelajaran-guru.show');
		Route::get('/mata-pelajaran-guru/{id}/edit', [MataPelajaranGuruController::class, 'edit']);
		Route::put('/mata-pelajaran-guru/{id}', [MataPelajaranGuruController::class, 'update']);
		Route::delete('/mata-pelajaran-guru/{id}', [MataPelajaranGuruController::class, 'destroy']);
		Route::get('/mata-pelajaran-guru/{siswaId}/input-nilai', [MataPelajaranGuruController::class, 'pageInputNilai']);
		Route::post('/mata-pelajaran-guru/input-nilai', [MataPelajaranGuruController::class, 'inputNilaiStore']);

		Route::get('/jadwal-kelas-guru', [JadwalKelasGuruController::class, 'index'])->name('jadwal-kelas-guru');
		Route::resource('/kelola-ruang-presensi-guru', KelolaRuangPresensiGuruController::class);
		Route::resource('/presensi-guru', PresensiGuruController::class);

		Route::resource('/upload-tugas-guru', UploadTugasGuruController::class);
		Route::post('/upload-tugas-guru/{id}/unduh-tugas', [UploadTugasGuruController::class, 'unduhTugas']);

		Route::resource('/capaian-kompetensi-guru', CapaianKompetensiGuruController::class);
		Route::get('/capaian-kompetensi-guru/{id}/input-capaian-kompetensi', [CapaianKompetensiGuruController::class, 'pageCapaianKompetensi'])->name('page-input-capaian-kompetensi-guru');
		Route::post('/capaian-kompetensi-guru/input-capaian-kompetensi', [CapaianKompetensiGuruController::class, 'inputCapaianKompetensiStore']);
		Route::get('/capaian-kompetensi-guru/{id}/show-capaian-kompetensi', [CapaianKompetensiGuruController::class, 'pageShowCapaianKompetensi']);
	});

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
});

Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');
