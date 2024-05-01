<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminResepController;
use App\Http\Controllers\PembelianBBController;

Route::get("login", [AuthController::class,'login'])->name('login');
Route::post('actionLogin',[ AuthController::class,'actionLogin'])->name('actionLogin');

Route::get('register', [AuthController::class,'register'])->name('register');
Route::post('register/action', [AuthController::class,'actionRegister'])->name('actionRegister');
Route::get('/register/verify/{verify_key}', [AuthController::class,'verify'])->name('verify');

Route::get('logout', [AuthController::class,'actionLogout'])->name('actionLogout')->middleware('auth');

Route::prefix('admin')->group(function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/resep', AdminResepController::class);
});

//pembelian

Route::prefix('mo')->group(function () {
    Route::resource('/pembelian', PembelianBBController::class);
});
