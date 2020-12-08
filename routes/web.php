<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EssentialOilCategoryController;
use App\Http\Controllers\EssentialOilProductController;
use App\Http\Controllers\EssentialOilTypeController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::prefix('/tinh-dau')->group(function () {
    Route::get('/', function () {
        $dataProduct = DB::table('essential_oil_products')
            ->select([
                'essential_oil_products.id',
                'essential_oil_products.FkEssentialOilCategory_id',
                'essential_oil_products.EssentialOilProduct_Name',
                'essential_oil_products.EssentialOilProduct_Vote',
                'essential_oil_products.EssentialOilProduct_Sapo',
                'essential_oil_products.EssentialOilProduct_Description',
                'essential_oil_products.EssentialOilProduct_Info',
                'essential_oil_products.EssentialOilProduct_Price',
                'essential_oil_products.EssentialOilProduct_Discount',
                'essential_oil_products.EssentialOilProduct_ListImage',
                'essential_oil_products.created_at',
                'essential_oil_products.updated_at',
                'essential_oil_categories.EssentialOilCategory_Name',

            ])
            ->join('essential_oil_categories',
                'essential_oil_categories.id',
                '=',
                'essential_oil_products.FkEssentialOilCategory_id')
            ->get();

        $dataProductDiscount = DB::table('essential_oil_products')
            ->select()
            ->where('EssentialOilProduct_Discount', '>', 0)
            ->get();

        $dataCategory = DB::table('essential_oil_types')
            ->select()
            ->get();


        return view('client.essentialOil.home')
            ->with(compact('dataCategory'))
            ->with(compact('dataProductDiscount'))
            ->with(compact('dataProduct'));

    })->name('essentialOilWelcome');

    Route::get('/detail/{id}', function ($id) {
        $data = DB::table('essential_oil_products')
            ->select()
            ->join('essential_oil_categories',
                'essential_oil_categories.id',
                '=',
                'essential_oil_products.FkEssentialOilCategory_id')
            ->where('essential_oil_products.id', '=', $id)
            ->get()->first();


        $dataProductSem = DB::table('essential_oil_products')
            ->select()
            ->join('essential_oil_categories',
                'essential_oil_categories.id',
                '=',
                'essential_oil_products.FkEssentialOilCategory_id')
            ->where('essential_oil_products.FkEssentialOilCategory_id', '=', $data->FkEssentialOilCategory_id)
            ->get();

        $idProduct = $id;
        $listImage = json_decode($data->EssentialOilProduct_ListImage);


        return view('client.essentialOil.detail')
            ->with(compact('data'))
            ->with(compact('idProduct'))
            ->with(compact('dataProductSem'))
            ->with(compact('listImage'));
    });
});



Route::prefix('/admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('adminLoginPage');
    Route::get('/logout', [AdminController::class, 'logout'])->name('adminLoginPage');
    Route::post('/submitLogin', [AdminController::class, 'submitLogin'])->name('adminLogin');
    Route::get('/register', [AdminController::class, 'store'])->name('registerAdmin');

    /*
     * Router middleware for Admin
     * */
    Route::middleware([IsAdmin::class])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('helloAdmin');
        Route::get('/home', [AdminController::class, 'index'])->name('helloAdmin');

        Route::get('/image/{id_image}', function ($id_image) {
            return response()->file(Storage::path('public/images/' . $id_image . '.jpg'));
        });

        /*
         * Essential Oil
         */
        /*------- For 'Product' -------*/
        Route::get('/essential-oil/product', [AdminController::class, 'index'])->name('essentialOiProductPage');
        Route::get('/essential-oil/product-add', [AdminController::class, 'index'])->name('addEssentialOiProductPage');
        Route::post('/essential-oil/product/add/sub-add', [EssentialOilProductController::class, 'store'])->name('addEssentialOiProduct');
        Route::get('/essential-oil/product/get-all', [EssentialOilProductController::class, 'getAll'])->name('getAllEssentialOiProduct');
        Route::get('/essential-oil/product-edit', [AdminController::class, 'index'])->name('editEssentialOiProductPanel');
        Route::post('/essential-oil/product/edit/sub-edit', [EssentialOilProductController::class, 'update'])->name('editEssentialOiProduct');

        /*------- For 'Type Product' -------*/
        Route::get('/essential-oil/type-product', [AdminController::class, 'index'])->name('essentialOiTypeProductPage');
        Route::post('/essential-oil/type-product/add', [EssentialOilTypeController::class, 'store'])->name('addEssentialOiTypeProduct');
        Route::post('/essential-oil/type-product/edit', [EssentialOilTypeController::class, 'edit'])->name('editEssentialOiTypeProduct');
        Route::post('/essential-oil/type-product/delete', [EssentialOilTypeController::class, 'delete'])->name('deleteEssentialOiTypeProduct');
        Route::get('/essential-oil/type-product/get-all', [EssentialOilTypeController::class, 'getAll'])->name('getAllEssentialOiTypeProduct');

        /*------- For 'Category Product' -------*/
        Route::get('/essential-oil/category-product', [AdminController::class, 'index'])->name('essentialOiCategoryProductPage');
        Route::post('/essential-oil/category-product/add', [EssentialOilCategoryController::class, 'store'])->name('addEssentialOiCategoryProduct');
        Route::get('/essential-oil/category-product/get-all', [EssentialOilCategoryController::class, 'getAll'])->name('getAllEssentialOiCategoryProduct');
        Route::post('/essential-oil/category-product/delete', [EssentialOilCategoryController::class, 'delete'])->name('deleteEssentialOiCategoryProduct');
        Route::post('/essential-oil/category-product/edit', [EssentialOilCategoryController::class, 'edit'])->name('editEssentialOiCategoryProduct');
    });
});

Route::get('/test', function () {
    $dataProduct = DB::table('essential_oil_products')
        ->select()
        ->join('essential_oil_categories',
            'essential_oil_categories.id',
            '=',
            'essential_oil_products.FkEssentialOilCategory_id')
        ->get();

    echo json_encode($dataProduct);
});

Route::get('/image/essential-oil/product/{id_product}/{id_image}', function ($id_product, $id_image) {
    return response()->file(Storage::path('public/images/essential-oil/product/' . $id_product . '/' . $id_image . '.png'));
});
Route::get('/image/essential-oil/type/{id_type}', function ($id_type) {
    return response()->file(Storage::path('public/images/essential-oil/type/' . $id_type . '/' . $id_type . '.png'));
});
