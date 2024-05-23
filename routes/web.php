<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPenitipController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\PengeluaranLainController;
use App\Models\DataPenitip;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminResepController;
use App\Http\Controllers\AdminDetailProduk;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PembelianBBController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileMoController;
use App\Http\Controllers\ProfileOwnerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KaryawanMobile;
use App\Http\Controllers\PresensiMobile;
use App\Http\Controllers\ProfileMobile;

use App\Http\Controllers\Api\ResetPassword;

Route::get("login", [AuthController::class, 'login'])->name('login');
Route::post('actionLogin', [AuthController::class, 'actionLogin'])->name('actionLogin');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register/action', [AuthController::class, 'actionRegister'])->name('actionRegister');
Route::get('/register/verify/{verify_key}', [AuthController::class, 'verify'])->name('verify');

Route::get('logout', [AuthController::class, 'actionLogout'])->name('actionLogout')->middleware('auth');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');

Route::get('/mo', function () {
    return view('mo.dashboard');
})->name('mo');

Route::get('/owner', function () {
    return view('owner.dashboard');
})->name('owner');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/history', [ProfileController::class, 'orderHistory'])->name('profile.history');


Route::prefix('admin')->group(function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/resep', AdminResepController::class);
    Route::resource('/datapenitip', DataPenitipController::class);
    Route::resource('/bahanbaku', BahanBakuController::class);

    Route::get('detailproduk/{id}', [AdminDetailProduk::class, 'index'])->name('detail.resep');
    Route::post('detailproduk/{id}', [AdminDetailProduk::class, 'store'])->name('detailProduk.store');
    Route::put('detailproduk/{id}/{id_resep}/update', [AdminDetailProduk::class, 'update'])->name('detailProduk.update');
    Route::delete('detailproduk/{id}/{id_resep}/delete', [AdminDetailProduk::class, 'destroy'])->name('detailProduk.destroy');

    Route::get('/profile/edit_password', [ProfileAdminController::class, 'editPassword'])->name('profile.editPassword');
    Route::post('/profile/update_password', [ProfileAdminController::class, 'updatePassword'])->name('profile.updatePassword');

Route::get('/pesanan_antar', [PesananController::class, 'index'])->name('pesanan.index');
Route::put('/pesanan/{id}/update-jarak', [PesananController::class, 'updateJarak'])->name('pesanan.updateJarak');


});

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('mo')->group(function () {
    Route::resource('/pembelian', PembelianBBController::class);
    Route::get('/create_pembelian', [PembelianBBController::class, 'create'])->name('mo.create_pembelian');
    Route::resource('/pengeluaranlain', PengeluaranLainController::class);
    Route::resource('/karyawan', KaryawanController::class);
    Route::get('/profile/edit_password', [ProfileMoController::class, 'editPassword'])->name('mo.profile.editPassword');
    Route::post('/profile/update_password', [ProfileMoController::class, 'updatePassword'])->name('mo.profile.updatePassword');
    
});

Route::prefix('owner')->group(function () {
    Route::get('/karyawann', [GajiController::class, 'index'])->name('owner.karyawann');
    Route::get('/edit_gaji/{karyawan}', [GajiController::class, 'editGaji'])->name('owner.edit_gaji');
    Route::put('/update_gaji/{karyawan}', [GajiController::class, 'updateGaji'])->name('owner.update_gaji');
    Route::get('/profile/edit_password', [ProfileOwnerController::class, 'editPassword'])->name('owner.profile.editPassword');
    Route::post('/profile/update_password', [ProfileOwnerController::class, 'updatePassword'])->name('owner.profile.updatePassword');
});

Route::get('costumer/index', [CustomerController::class, 'index']);
Route::get('costumer/fetchPemesanan/{id}', [CustomerController::class, 'fetchPemesanan']);


Route::get('costumer/fetchAll', [CustomerController::class, 'fetchAll']);
Route::get('bahanbaku/fetchAll', [BahanBakuController::class, 'fetchAll']);
Route::get('datapenitip/fetchAll', [DataPenitipController::class, 'fetchAll']);
Route::get('pengeluaranlain/fetchAll', [PengeluaranLainController::class, 'fetchAll']);

Route::resource('/karyawanMobile', KaryawanMobile::class);
Route::resource('/presensiMobile', PresensiMobile::class);
Route::resource('/profileMobile', ProfileMobile::class);

Route::get('resetPassword', function () {
    return view('resetPassword');
})->name('resetPassword');
