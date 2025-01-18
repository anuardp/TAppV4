<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalSidangController;
// use App\Http\Middleware\RoleMiddleware;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/dosen/dashboard', [DashboardController::class, 'dosenDashboard'])->name('dosen.dashboard');
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswaDashboard'])->name('mahasiswa.dashboard');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
});

Route::get('/admin/mahasiswa.create', [AdminController::class, 'createMahasiswa'])->name('admin.mahasiswa.create');
Route::post('/admin/mahasiswa.store', [AdminController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');

Route::get('/admin/dosen.create', [AdminController::class, 'createDosen'])->name('admin.dosen.create');
Route::post('/admin/dosen.store', [AdminController::class, 'storeDosen'])->name('admin.dosen.store');

Route::get('/admin/daftar-mahasiswa', [AdminController::class, 'daftarMahasiswa'])->name('daftar.mahasiswa');
Route::get('/admin/daftar-dosen', [AdminController::class, 'daftarDosen'])->name('daftar.dosen');

Route::get('/admin/jadwal-create', [AdminController::class, 'formJadwalSidang'])->name('admin.jadwal.create');
Route::post('/admin/jadwal-sidang/store', [AdminController::class, 'storeJadwalSidang'])->name('admin.jadwal.store');


Route::get('/admin/jadwal-sidang', [AdminController::class, 'listJadwalSidang'])->name('admin.jadwal.list');
Route::put('/admin/jadwal-sidang/{id}/status', [AdminController::class, 'updateStatusSidang'])->name('admin.jadwal.updateStatus');

Route::get('/dosen/jadwal-sidang', [DosenController::class, 'cekJadwalSidang'])->name('dosen.jadwal.sidang');
Route::get('/dosen/jadwal-sidang/{id}/isi-nilai', [DosenController::class, 'isiNilai'])->name('dosen.jadwal.isiNilai');
Route::post('/dosen/jadwal-sidang/{id}/simpan-nilai', [DosenController::class, 'simpanNilai'])->name('dosen.jadwal.simpanNilai');
Route::get('/dosen/jadwal-sidang/{id}/edit-nilai', [DosenController::class, 'editNilai'])->name('dosen.jadwal.editNilai');
Route::put('/dosen/jadwal-sidang/{id}/update-nilai', [DosenController::class, 'updateNilai'])->name('dosen.jadwal.updateNilai');
Route::put('/dosen/jadwal-sidang/{id}/finalisasi', [DosenController::class, 'finalisasiNilai'])->name('dosen.jadwal.finalisasiNilai');


// Route::get('/isi-nilai', function () {
//     return view('dosen.isi-nilai-sidang');
// });
// Route::get('/jadwal-sidang/{id}/isi', [DosenController::class, 'isiNilai'])->name('isi-nilai-sidang');
// Route::post('/jadwal-sidang/{id}/isi', [DosenController::class, 'storeNilai'])->name('store-nilai-sidang');
// Route::get('/jadwal-sidang/{id}/edit', [DosenController::class, 'isiNilai'])->name('edit-nilai-sidang');
// Route::put('/jadwal-sidang/{id}/edit', [DosenController::class, 'storeNilai'])->name('update-nilai-sidang');
// Route::get('/jadwal-sidang/{id}/edit', function ($id) {
//     return app(JadwalSidangController::class)->isiNilai($id, true);
// })->name('edit-nilai-sidang');
// Route::put('/jadwal-sidang/{id}/edit', [JadwalSidangController::class, 'storeNilai'])->name('update-nilai-sidang');