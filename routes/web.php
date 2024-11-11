<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IzinController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route untuk tamu (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register']);
    Route::get('/register/test/{id}', [RegistrationController::class, 'showTestForm'])->name('registration.test');
    Route::post('/register/test/{id}', [RegistrationController::class, 'submitTest'])->name('registration.submit-test');
    Route::get('/register/complete/{id}', [RegistrationController::class, 'showCompletionPage'])->name('registration.complete');
});

// Route untuk anggota yang sudah login
Route::middleware(['auth', 'role:anggota_magang'])->group(function () {
    Route::get('/dashboard', [MagangController::class, 'dashboard'])->name('dashboard');
    
    // Absensi
    Route::get('/absensi', [AbsensiController::class, 'absensi'])->name('absensi');
    Route::post('/absensi/validateToken', [AbsensiController::class, 'validateToken'])->name('absensi.validateToken');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');

    // Izin
    Route::get('/izin', [IzinController::class, 'izin'])->name('izin');
    Route::post('/izin/validateToken', [IzinController::class, 'validateToken'])->name('izin.validateToken');
    Route::post('/izin', [IzinController::class, 'store'])->name('izin.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Hapus atau komentari baris ini jika Anda tidak menggunakan fitur autentikasi bawaan Laravel
require __DIR__.'/auth.php';