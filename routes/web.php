<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminResepController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Api\AuthController;

Route::get("login", [AuthController::class,'login'])->name('login');
Route::post('actionLogin',[ AuthController::class,'actionLogin'])->name('actionLogin');

Route::get('register', [AuthController::class,'register'])->name('register');
Route::post('register/action', [AuthController::class,'actionRegister'])->name('actionRegister');
Route::get('/register/verify/{verify_key}', [AuthController::class,'verify'])->name('verify');

Route::get('logout', [AuthController::class,'actionLogout'])->name('actionLogout')->middleware('auth');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');

Route::prefix('admin')->group(function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/resep', AdminResepController::class);
    Route::resource('/karyawan', KaryawanController::class);
});

