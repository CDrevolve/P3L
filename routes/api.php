<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthMobileController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\Api\ProdukMobileController;
use App\Http\Controllers\Api\PesananMobileController;
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


Route::get('/produk', [ProdukMobileController::class, 'index']);
Route::get('/produk/{id}', [ProdukMobileController::class, 'show']);

Route::middleware('auth:api')->group(function () {
    Route::get('/pesananMobile', [PesananMobileController::class, 'index']);
    Route::put('/pesananMobile/{id}', [PesananMobileController::class, 'updateStatus']);
});