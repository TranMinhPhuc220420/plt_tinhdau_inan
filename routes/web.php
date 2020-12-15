<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderEssentialOilController;
use App\Http\Controllers\OrderPrintController;
use App\Http\Controllers\PrintProductController;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EssentialOilCategoryController;
use App\Http\Controllers\EssentialOilProductController;
use App\Http\Controllers\EssentialOilTypeController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


/*
 * Essential Old Router
 * */
Route::prefix('/essential-oil')->group(function () {
  Route::get('/', function () {
    session('userLive', 213);

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
      ->limit(9)
      ->orderBy('created_at', 'desc')
      ->get();

    $dataProductDiscount = DB::table('essential_oil_products')
      ->select()
      ->where('EssentialOilProduct_Discount', '>', 0)
      ->orderBy('created_at', 'desc')
      ->limit(12)
      ->get();

    $dataCategory = DB::table('essential_oil_categories')
      ->orderBy('created_at', 'desc')
      ->select()
      ->limit(3)
      ->get();

    //Value set fast
    $title = 'Trang chủ tinh dầu';
    return view('client.essentialOil.home')
      ->with(compact('dataCategory'))
      ->with(compact('dataProductDiscount'))
      ->with(compact('title'))
      ->with(compact('dataProduct'));
  });

  Route::get('/detail/{random}/{date}/{id}/{name}', function ($detail, $date, $id, $name) {
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
      ->orderBy('created_at', 'desc')
      ->where('essential_oil_products.FkEssentialOilCategory_id', '=', $data->FkEssentialOilCategory_id)
      ->where('essential_oil_products.id', '<>', $id)
      ->get();

    $dataComment = DB::table('comments')
      ->select()
      ->where('FkEssentialOilProduct_id', '=', $id)
      ->get();

    //Value set fast
    $idProduct = $id;
    $listImage = json_decode($data->EssentialOilProduct_ListImage);
    $title = 'Chi tiết sản phẩm';

    return view('client.essentialOil.detail')
      ->with(compact('data'))
      ->with(compact('idProduct'))
      ->with(compact('dataProductSem'))
      ->with(compact('listImage'))
      ->with(compact('title'))
      ->with(compact('dataComment'));
  });

  Route::get('/shop/{id}/{name}/{time}', function ($id, $name, $time) {
    $searchBy = 'category';

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
      ->where('essential_oil_products.FkEssentialOilCategory_id', '=', $id)
      ->join('essential_oil_categories',
        'essential_oil_categories.id',
        '=',
        'essential_oil_products.FkEssentialOilCategory_id')
      ->limit(9)
      ->orderBy('created_at', 'desc')
      ->get();

    $categorySearch = DB::table('essential_oil_categories')
      ->select()
      ->where('id', '=', $id)
      ->get()->first();

    // Set value fast
    $categoryName = $categorySearch->EssentialOilCategory_Name;
    $isSearch = true;
    $title = 'Sản phẩm theo loại đã chọn';

    return view('client.essentialOil.shop')
      ->with(compact('isSearch'))
      ->with(compact('dataProduct'))
      ->with(compact('searchBy'))
      ->with(compact('title'))
      ->with(compact('categoryName'));
  });

  Route::get('/shop/', function () {
    $searchBy = '';

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
      ->limit(9)
      ->orderBy('created_at', 'desc')
      ->get();

    //Set value fast
    $isSearch = false;
    $title = 'Sản phẩm có trong cửa hàng';

    return view('client.essentialOil.shop')
      ->with(compact('isSearch'))
      ->with(compact('searchBy'))
      ->with(compact('title'))
      ->with(compact('dataProduct'));
  });

  Route::get('/cart/', function () {
    return view('client.essentialOil.cart');
  });

  Route::get('/search', function (Request $request) {
    $keySearch = $request->get('key');
    $columnsSelect = [
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
    ];
    $isSearch = false;
    $categoryName = '';
    $searchBy = '';
    $dataProduct = null;

    //Set search by category name
    $resultCategory = DB::table('essential_oil_categories')
      ->select()
      ->where('EssentialOilCategory_Name', 'like', $keySearch . '%')
      ->orderBy('created_at', 'desc')
      ->get()->first();

    if ($resultCategory) {
      $isSearch = true;
      $searchBy = 'category';
      $categoryName = $resultCategory->EssentialOilCategory_Name;
      $dataProduct = DB::table('essential_oil_products')
        ->select($columnsSelect)
        ->where('essential_oil_products.FkEssentialOilCategory_id', '=', $resultCategory->id)
        ->join('essential_oil_categories',
          'essential_oil_categories.id',
          '=',
          'essential_oil_products.FkEssentialOilCategory_id')
        ->orderBy('created_at', 'desc')
        ->get();
    } else {
      $isSearch = false;

      $dataProduct = DB::table('essential_oil_products')
        ->select($columnsSelect)
        ->where('EssentialOilProduct_Name', '=', $keySearch)
        ->join('essential_oil_categories',
          'essential_oil_categories.id',
          '=',
          'essential_oil_products.FkEssentialOilCategory_id')
        ->orderBy('created_at', 'desc')
        ->get();
      $searchBy = 'nameProduct';

//      if ($dataProduct) {
      $searchBy = 'description';
      $dataProduct = DB::table('essential_oil_products')
        ->select($columnsSelect)
        ->where('EssentialOilProduct_Sapo', '=', $keySearch)
        ->join('essential_oil_categories',
          'essential_oil_categories.id',
          '=',
          'essential_oil_products.FkEssentialOilCategory_id')
        ->orderBy('created_at', 'desc')
        ->get();
//      }
    }

    //Set value fast
    $title = 'Kết quả tìm kiếm sản phẩm';

    return view('client.essentialOil.shop')
      ->with(compact('isSearch'))
      ->with(compact('dataProduct'))
      ->with(compact('categoryName'))
      ->with(compact('title'))
      ->with(compact('searchBy'));

  })->name('essential-oil-search');

  Route::post('/addComment', [CommentController::class, 'store'])->name('essentialOilAddNewComment');

  Route::post('/addOrder', [OrderEssentialOilController::class, 'store'])->name('essentialOilAddNewOrder');
});

/*
 * Print Store
 * */
Route::prefix('/print-store')->group(function () {
  //Index
  Route::get('/cart', function () {
    //Value set fast
    $title = 'Trang chủ tinh dầu';
    return view('client.printStore.cart')
      ->with(compact('title'));
  });

  //Index
  Route::get('/', function () {
    $dataProduct = DB::table('print_products')
      ->select()
      ->orderBy('created_at', 'desc')
      ->get();

    //Value set fast
    $title = 'Trang chủ tinh dầu';
    return view('client.printStore.home')
      ->with(compact('dataProduct'));
  });

  Route::get('/detail/{random}/{date}/{id}/{name}', function ($detail, $date, $id, $name) {
    $data = DB::table('print_products')
      ->select()
      ->where('id', '=', $id)
      ->get()->first();


    $dataProductSem = DB::table('print_products')
      ->select()
      ->where('id', '<>', $id)
      ->orderBy('created_at', 'desc')
      ->get();

    $dataComment = DB::table('comments')
      ->select()
      ->where('FkPrintProduct_id', '=', $id)
      ->orderBy('created_at', 'desc')
      ->get();


    //Value set fast
    $dataListPrice = json_decode($data->PrintProduct_ListPrice);
    $idProduct = $id;
    $listImage = json_decode($data->PrintProduct_ListImage);
    $title = 'Chi tiết sản phẩm';

    return view('client.printStore.detail')
      ->with(compact('data'))
      ->with(compact('idProduct'))
      ->with(compact('dataProductSem'))
      ->with(compact('listImage'))
      ->with(compact('title'))
      ->with(compact('dataComment'))
      ->with(compact('dataListPrice'));
  });

  Route::post('/addOrder', [OrderPrintController::class, 'store'])->name('printStoreAddNewOrder');
});


/*
 * Admin Router
 * */
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
    Route::get('/essential-oil/product', [AdminController::class, 'index'])->name('essentialOiProductPage');
    Route::get('/essential-oil/product-add', [AdminController::class, 'index'])->name('addEssentialOiProductPage');
    Route::post('/essential-oil/product/add/sub-add', [EssentialOilProductController::class, 'store'])->name('addEssentialOiProduct');
    Route::get('/essential-oil/product/get-all', [EssentialOilProductController::class, 'getAll'])->name('getAllEssentialOiProduct');
    Route::get('/essential-oil/product-edit', [AdminController::class, 'index'])->name('editEssentialOiProductPanel');
    Route::post('/essential-oil/product/edit/sub-edit', [EssentialOilProductController::class, 'update'])->name('editEssentialOiProduct');
    Route::post('/essential-oil/product/delete', [EssentialOilProductController::class, 'delete'])->name('deleteEssentialOiProduct');

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

    /*
     * PRINT
     */
    /*------- For 'Product' -------*/
    Route::get('/print-store/product/', [AdminController::class, 'index'])->name('printProductPage');
    Route::get('/print-store/product-add', [AdminController::class, 'index'])->name('printProductPage');
    Route::post('/print-store/product/add/sub-add', [PrintProductController::class, 'store'])->name('addPrintProduct');
    Route::post('/print-store/product/get-all', [PrintProductController::class, 'getAll'])->name('getAllPrintProduct');
    Route::post('/print-store/product/edit/sub-edit', [PrintProductController::class, 'update'])->name('updatePrintProduct');
    Route::post('/print-store/product/delete/sub-delete', [PrintProductController::class, 'delete'])->name('updatePrintProduct');

    /*
     * PRINT STORE ORDER
     */
    /*------- For 'Order' -------*/
    Route::get('/print-store/order/get-all', [OrderPrintController::class, 'getAll'])->name('getAllOrder');

  });
});

/*
 * Test Router
 * */
Route::get('/test', function (Request $request) {
  Session::put('key', 999999);
  $test = Session::get('key');
  echo $test;
  Session::remove('key');
  Session::put('key', 12312312);
  $test = Session::get('key');
  echo $test;
});

Route::post('/test-post', function (Request $request) {

});

/*
 * Public Router
 * */
Route::prefix('/image/essential-oil/')->group(function () {
  Route::get('/product/{id_product}/{id_image}', function ($id_product, $id_image) {
    return response()->file(Storage::path('public/images/essential-oil/product/' . $id_product . '/' . $id_image . '.png'));
  });
  Route::get('/type/{id_type}', function ($id_type) {
    return response()->file(Storage::path('public/images/essential-oil/type/' . $id_type . '/' . $id_type . '.png'));
  });
  Route::get('/category/{id_type}', function ($id_type) {
    return response()->file(Storage::path('public/images/essential-oil/category/' . $id_type . '/' . $id_type . '.png'));
  });
});
Route::prefix('/image/print-store/')->group(function () {
  Route::get('/product/{id_product}/{id_image}', function ($id_product, $id_image) {
    return response()->file(Storage::path('public/images/print-store/product/' . $id_product . '/' . $id_image . '.png'));
  });
});

Route::get('/', function () {
  return view('welcome');
})->name('welcome');

Route::get('/contact/', function () {
  return view('contact');
});
