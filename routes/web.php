<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataPenitipController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\PengeluaranLainController;
use App\Models\DataPenitip;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('datapenitip', DataPenitipController::class);
Route::resource('bahanbaku', BahanBakuController::class);
Route::resource('pengeluaranlain', PengeluaranLainController::class);

Route::get('bahanbaku/fetchAll', [BahanBakuController::class, 'fetchAll']);
Route::get('datapenitip/fetchAll', [DataPenitipController::class, 'fetchAll']);
Route::get('pengeluaranlain/fetchAll', [PengeluaranLainController::class, 'fetchAll']);
