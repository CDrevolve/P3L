<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminResepController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Api\AuthController;

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');


Route::prefix('admin')->group(function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/resep', AdminResepController::class);
    Route::resource('/karyawan', KaryawanController::class);
});

Route::get('/login', function () {
    return view('login');
});
