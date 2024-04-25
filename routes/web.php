<?
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Api\AuthController;

Route::prefix('admin')->group(function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/resep', AdminResepController::class);
});

Route::get('/login', function () {
    return view('login');
});
