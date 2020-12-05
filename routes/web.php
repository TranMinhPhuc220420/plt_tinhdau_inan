<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::prefix('/admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('adminLoginPage');
    Route::get('/logout', [AdminController::class, 'logout'])->name('adminLoginPage');
    Route::post('/submitLogin', [AdminController::class, 'submitLogin'])->name('adminLogin');
    Route::get('/register', [AdminController::class, 'store'])->name('registerAdmin');

    /*
     * Router middleware for Admin
     * */
    Route::middleware([IsAdmin::class])->group(function () {
        Route::get('/home', [AdminController::class, 'index'])->name('welcome');

        Route::get('/image/{id_image}', function ($id_image) {
            return response()->file(Storage::path('public/images/' . $id_image . '.jpg'));
        });
    });
});
