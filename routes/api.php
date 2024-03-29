<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

/*
 * Admin Router
 * */
Route::prefix('/admin')->group(function () {
  /*
 * Router middleware for Admin
 * */
  Route::get('/home/get-data-live', function () {
    $countProduct = DB::table('print_products')
      ->select()
      ->get()->count();

    $countProduct += DB::table('essential_oil_products')
      ->select()
      ->get()->count();

    $countOrder = DB::table('order_essential_oil')
      ->select()
      ->get()->count();

    $countOrder += DB::table('order_prints')
      ->select()
      ->get()->count();

    echo json_encode([
      'userLive' => rand(0, 5),
      'countFeedBack' => 0,
      'countProduct' => $countProduct,
      'countOrder' => $countOrder,
    ]);
  });
});
