<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EssentialOilCategoryController;
use App\Http\Controllers\EssentialOilTypeController;
use App\Http\Middleware\IsAdmin;
use App\Models\EssentialOilCategory;
use App\Models\EssentialOilType;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


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
        Route::get('/home', [AdminController::class, 'index'])->name('helloAdmin');

        Route::get('/image/{id_image}', function ($id_image) {
            return response()->file(Storage::path('public/images/' . $id_image . '.jpg'));
        });

        /*
         * Essential Oil
         */
        /*------- For 'Product' -------*/
        Route::get('/essential-oil/product', [AdminController::class, 'index'])->name('essentialOiProduct');

        /*------- For 'Type Product' -------*/
        Route::get('/essential-oil/type-product', [AdminController::class, 'index'])->name('essentialOiTypeProduct');
        Route::post('/essential-oil/type-product/add', [EssentialOilTypeController::class, 'store'])->name('addEssentialOiTypeProduct');
        Route::post('/essential-oil/type-product/edit', [EssentialOilTypeController::class, 'edit'])->name('editEssentialOiTypeProduct');
        Route::post('/essential-oil/type-product/delete', [EssentialOilTypeController::class, 'delete'])->name('deleteEssentialOiTypeProduct');
        Route::get('/essential-oil/type-product/get-all', [EssentialOilTypeController::class, 'getAll'])->name('getAllEssentialOiTypeProduct');

        /*------- For 'Category Product' -------*/
        Route::get('/essential-oil/category-product', [AdminController::class, 'index'])->name('essentialOiCategoryProduct');
        Route::post('/essential-oil/category-product/add', [EssentialOilCategoryController::class, 'store'])->name('addEssentialOiCategoryProduct');
        Route::get('/essential-oil/category-product/get-all', [EssentialOilCategoryController::class, 'getAll'])->name('getAllEssentialOiCategoryProduct');
        Route::post('/essential-oil/category-product/delete', [EssentialOilCategoryController::class, 'delete'])->name('deleteEssentialOiCategoryProduct');
        Route::post('/essential-oil/category-product/edit', [EssentialOilCategoryController::class, 'edit'])->name('editEssentialOiCategoryProduct');
    });
});

Route::get('/test', function () {
//    $test = new EssentialOilCategory();
//    $test->EssentialOilCategory_Name = 'test_2';
//    $test->essential_oil_types_id = 1607252483;
//    $test->save();


//    $test = EssentialOilCategory::where('id', 1)->first();
//    echo json_encode($test->essentialOilType);

    $test = EssentialOilType::where('id', 1607252483)->get()->first();
    echo json_encode($test->essentialOilCategory);
});
