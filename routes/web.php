<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPenitipController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\PengeluaranLainController;
use App\Models\DataPenitip;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminResepController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProfileController;
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

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/history', [ProfileController::class, 'orderHistory'])->name('profile.history');


Route::prefix('admin')->group(function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/resep', AdminResepController::class);
    Route::resource('/karyawan', KaryawanController::class);
    Route::resource('datapenitip', DataPenitipController::class);
    Route::resource('bahanbaku', BahanBakuController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pengeluaranlain', PengeluaranLainController::class);

Route::get('bahanbaku/fetchAll', [BahanBakuController::class, 'fetchAll']);
Route::get('datapenitip/fetchAll', [DataPenitipController::class, 'fetchAll']);
Route::get('pengeluaranlain/fetchAll', [PengeluaranLainController::class, 'fetchAll']);
