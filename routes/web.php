<?php

use App\Http\Controllers\KontakController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Route default ke halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Route ke controller WelcomeController@index
Route::get('/', [WelcomeController::class, 'index']);

// Grup route dengan prefix 'kontak'
Route::group(['prefix' => 'kontak'], function () {
    // Tampilkan halaman utama daftar kontak
    Route::get('/', [KontakController::class, 'index']);

    // Ambil data kontak dalam format DataTables (AJAX)
    Route::post('/list', [KontakController::class, 'list']);

    // Tampilkan form tambah kontak
    Route::get('/create', [KontakController::class, 'create']);

    // Proses simpan data kontak baru
    Route::post('/store', [KontakController::class, 'store']);

    // Tampilkan detail kontak
    Route::get('/{id}/show', [KontakController::class, 'show']);

    // Tampilkan form edit data kontak
    Route::get('/{id}/edit', [KontakController::class, 'edit']);

    // Proses update data kontak
    Route::put('/{id}', [KontakController::class, 'update']);

    // Tampilkan konfirmasi sebelum menghapus kontak
    Route::get('{id}/delete', [KontakController::class, 'confirm']);

    // Proses hapus data kontak dengan konfirmasi
    Route::delete('/{id}/delete', [KontakController::class, 'delete']);

    // Proses hapus data kontak langsung
    Route::delete('/{id}', [KontakController::class, 'destroy']);
});
