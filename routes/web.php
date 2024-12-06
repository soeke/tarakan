<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UjianBackendController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index_dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


 // Backend
 Route::group(['prefix' => '23', 'middleware' => ['auth']], function () {

    //Numpang UTM Masuk
    Route::prefix('utm/numpang-masuk')->controller(UjianBackendController::class)->group(function() {
            Route::get('/', 'index_unm')->name('index_backend_unm');
            Route::get('add', 'add_unm')->name('add_backend_unm');
            Route::get('show/{id}', 'show_unm')->name('show_backend_unm');
            Route::post('store', 'store_unm')->name('store_backend_unm');
            Route::get('edit/{id}', 'edit_unm')->name('edit_backend_unm');
            Route::post('update/{id}', 'update_unm')->name('update_backend_unm');
            Route::get('print/{id}', 'print_ktpu_unm')->name('print_ktpu_backend_unm');
            Route::get('show-all', 'show_all_unm')->name('show_all_backend_unm');
            Route::get('absen', 'absen_unm')->name('absen_backend_unm');
            Route::get('rekap', 'rekap_unm')->name('rekap_backend_unm');

            Route::get('/get-tempat-ujian', 'GetTempatUjian')->name('get_tempat_ujian');
    });

}); 