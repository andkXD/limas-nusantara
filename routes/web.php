<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\KatalogController;
use App\Http\Controllers\Member\TransaksiController as MemberTransaksiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\Admin\KontenController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('anggota.login'));

// ==================== AUTH ====================

// Anggota
Route::get('/login', [AuthController::class, 'showAnggotaLogin'])->name('anggota.login');
Route::post('/login', [AuthController::class, 'loginAnggota'])->name('anggota.login.submit');

// Admin
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== MEMBER AREA ====================

Route::middleware('auth:web')->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
    Route::post('/katalog/{buku}/pinjam', [KatalogController::class, 'pinjam'])->name('katalog.pinjam');
    Route::get('/riwayat', [MemberTransaksiController::class, 'riwayat'])->name('riwayat');
});

// ==================== ADMIN AREA ====================

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Resource Buku
    Route::resource('buku', BukuController::class);

    // Resource Anggota
    Route::resource('anggota', AnggotaController::class)->except(['destroy', 'show']);
    Route::patch('anggota/{anggotum}/toggle-status', [AnggotaController::class, 'toggleStatus'])->name('anggota.toggle-status');

    // Transaksi (Validasi Peminjaman & Pengembalian + Denda)
    Route::get('transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{transaksi}', [AdminTransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('transaksi/{transaksi}/proses-pengembalian', [AdminTransaksiController::class, 'prosesPengembalian'])->name('transaksi.proses-pengembalian');
    Route::post('transaksi/{transaksi}/lunas', [AdminTransaksiController::class, 'konfirmasiLunas'])->name('transaksi.lunas');

    // Resource Konten
    Route::resource('konten', KontenController::class);
});