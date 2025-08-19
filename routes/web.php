<?php

use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KelolaGuruKelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\AjaxLoadController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guru\DataSiswaController;
use App\Http\Controllers\Guru\KelolaPembelajaranController;
use App\Http\Controllers\Admin\KelolaSiswaKelasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guru\UserController as GuruUserController;
use App\Http\Controllers\Siswa\TugasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');
Route::post('/', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/pengaturan-akun', [AuthController::class, 'edit'])->name('pengaturan-akun.edit');
Route::put('/pengaturan-akun', [AuthController::class, 'update'])->name('pengaturan-akun.update');
Route::get('/search-siswa-kelas', [AjaxLoadController::class, 'getSiswaKelas'])->name('search.siswa.kelas');
Route::get('/search-kelas', [AjaxLoadController::class, 'getKelas'])->name('search.kelas');
Route::get('/search-mapel', [AjaxLoadController::class, 'getMapel'])->name('search.mapel');
Route::get('/search-guru-mapel', [AjaxLoadController::class, 'getGuruMapel'])->name('search.guru-mapel');

Route::middleware(['auth', 'role:1'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/user', UserController::class);
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/guru', GuruController::class);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/mapel', MapelController::class);
    Route::resource('/kelola-guru-kelas', KelolaGuruKelasController::class);
    Route::resource('/kelola-siswa-kelas', KelolaSiswaKelasController::class);
    Route::get('/edit-akun/{id}', [AkunController::class, 'edit'])->name('akun.edit');
    Route::put('/ubah-akun/{id}', [AkunController::class, 'updateAkun'])->name('akun.update');
    Route::put('/ubah-password/{id}', [AkunController::class, 'updatePassword'])->name('password.update');
});
Route::middleware(['auth', 'role:2'])->name('guru.')->prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/edit-username', [GuruUserController::class, 'editUsername'])->name('user.edit-username');
    Route::put('/user/update-username', [GuruUserController::class, 'updateUsername'])->name('user.update-username');
    Route::get('/user/edit-password', [GuruUserController::class, 'editPassword'])->name('user.edit-password');
    Route::put('/user/update-password', [GuruUserController::class, 'updatePassword'])->name('user.update-password');
    Route::resource('/data-siswa', DataSiswaController::class);
    Route::resource('/kelola-pembelajaran', KelolaPembelajaranController::class);
    Route::get('/kelola-pembelajaran/diskusi-materi/{materi}', [KelolaPembelajaranController::class, 'diskusi'])->name('kelola-pembelajaran.diskusi-materi');
});
Route::middleware(['auth', 'role:3'])->name('siswa.')->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{mapel_id}/materi', [TugasController::class, 'listMateri'])->name('tugas.list-materi');
    Route::get('/tugas/materi/{materi_id}', [TugasController::class, 'showMateri'])->name('tugas.show-materi');
    Route::post('/tugas/materi/{materi_id}/tanggapan', [TugasController::class, 'storeTanggapan'])->name('tugas.tanggapan-materi.store');
    Route::get('/tugas/materi/{materi_id}/tanggapan', [TugasController::class, 'loadTanggapanPartial'])->name('tugas.tanggapan-materi.load');
});
