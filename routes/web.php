<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminBukuController;
use App\Http\Controllers\Admin\AdminPeminjamanController;
use App\Http\Controllers\Siswa\SiswaDashboardController;
use App\Http\Controllers\Siswa\SiswaPeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return match (Auth::user()->role) {
        'admin' => redirect('/admin/dashboard'),
        default => redirect('/siswa/dashboard'),
    };
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// route siswa
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    // Peminjaman
    Route::get('/buku', [SiswaPeminjamanController::class, 'index'])->name('buku.index');
    // form pinjam
    Route::get('/pinjam/{id}', [SiswaPeminjamanController::class, 'create'])->name('pinjam.form');
    // simpan pinjam
    Route::post('/pinjam', [SiswaPeminjamanController::class, 'store'])->name('pinjam.store');
    // daftar pinjaman
    Route::get('/peminjaman', [SiswaPeminjamanController::class, 'peminjaman'])->name('peminjaman.index');
    // kembalikan
    Route::post('/kembalikan/{id}', [SiswaPeminjamanController::class, 'kembalikan'])->name('kembalikan');
});

// route admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // CRUD User
    Route::resource('users', AdminUserController::class);
    // CRUD Kategori
    Route::resource('kategoris', AdminKategoriController::class);
    // CRUD Buku
    Route::resource('buku', AdminBukuController::class);
    // Peminjaman
    Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/konfirmasi/{id}', [AdminPeminjamanController::class, 'konfirmasi'])->name('konfirmasi');
});

require __DIR__ . '/auth.php';
