<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminResepController;

Route::prefix('admin')->group(function () {
    Route::resource('/resep', AdminResepController::class);
});



