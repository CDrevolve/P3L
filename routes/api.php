<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthMobileController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\Api\ProdukMobileController;
use App\Http\Controllers\Api\StokBahanBakuController;
use App\Http\Controllers\Api\AjuanSaldoMobile;
use App\Http\Controllers\Api\LaporanPPMobile;
use App\Http\Controllers\Api\PesanannMobileController;
use App\Http\Controllers\Api\LaporanMobileController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/loginMobile', [AuthMobileController::class, 'login']);

Route::post('fetchAll', [AuthController::class, 'fetchAll']);
Route::post('forgetPasswordMobile/sendEmail', [ForgetPasswordController::class, 'sendEmailMobile'])->name('sendEmailMobile');



// Route::get('/produk', [ProdukMobileController::class, 'index']);
// Route::get('/produk/{id}', [ProdukMobileController::class, 'show']);
Route::get('/bahan-baku', [StokBahanBakuController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/produk', [ProdukMobileController::class, 'index']);
    Route::get('/produk/{id}', [ProdukMobileController::class, 'show']);
    Route::resource('ajuanSaldoMobile', AjuanSaldoMobile::class);
    Route::get('showCustomer', [AuthMobileController::class, 'showCustomer']);
    Route::post('laporanPPMobile/laporan', [LaporanPPMobile::class, 'laporan'])->name('laporanPPMobile.laporan');
});



Route::get('/produk/{id}', [ProdukMobileController::class, 'show']);


Route::middleware('auth:api')->group(function () {
    Route::get('/pesanannMobile', [PesanannMobileController::class, 'index']);
    Route::put('/pesanannMobile/{id}', [PesanannMobileController::class, 'updateStatus']);
    Route::get('/laporan-penjualan-tahunan', [LaporanMobileController::class, 'laporanPenjualanTahunan']);
    Route::get('/download-pdf', [LaporanMobileController::class, 'downloadPDF']);
    Route::get('/laporan-penggunaan-bahan-baku', [LaporanMobileController::class, 'laporanPenggunaanBahanBaku']);
    Route::get('/download-penggunaan-bahan-baku-pdf', [LaporanMobileController::class, 'downloadPenggunaanBahanBakuPDF']);
});
