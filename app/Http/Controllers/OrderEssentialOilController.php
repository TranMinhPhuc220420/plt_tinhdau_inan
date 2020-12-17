<?php

namespace App\Http\Controllers;

use App\Models\OrderEssentialOil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderEssentialOilController extends Controller
{
  public function store(Request $request)
  {
    //Get value param
    $listProduct = $request->get('listProduct');
    $userFullName = $request->get('fullName');
    $userPhoneNumber = $request->get('phoneNumber');
    $userEmail = $request->get('email');
    $userAddress = $request->get('address');
    $userNote = $request->get('note');

    $newOrder = new OrderEssentialOil();
    $idOrder = time();

    $newOrder->id = $idOrder;
    $newOrder->Order_FullNameUser = $userFullName;
    $newOrder->Order_PhoneNumber = $userPhoneNumber;
    $newOrder->Order_EmailUser = $userEmail;
    $newOrder->Order_AddressUserSend = $userAddress;
    $newOrder->Order_ListProduct = $listProduct;
    $newOrder->Order_Note = $userNote;
    $newOrder->save();

    echo json_encode(['status' => 200, 'message' => 'ok']);
  }

  public function getAll()
  {
    $data = DB::table('order_essential_oil')
      ->orderBy('created_at', 'desc')
      ->get();

    for ($i = 0; $i < $data->count(); $i++) {
      $listProductOrderRaw = json_decode($data[$i]->Order_ListProduct);
      $listProductOrder = [
        'countOrder' => 0,
        'listProduct' => [],
      ];

      foreach ($listProductOrderRaw as $item) {
        $itemProduct = DB::table('essential_oil_products')
          ->select(
            'id',
            'EssentialOilProduct_Name',
            'EssentialOilProduct_Price',
          )->where('id', '=', $item->idProduct)->get()->first();

        $listProductOrder['countOrder'] += ($itemProduct->EssentialOilProduct_Price * $item->count);
        array_push($listProductOrder['listProduct'], ['dataProduct' => $itemProduct, 'count' => $item->count]);
      }

      $data[$i]->Order_ListProduct = $listProductOrder;
    }

    echo json_encode(['data' => $data]);
  }

  public function updateStatus(Request $request)
  {
    $idOrder = $request->get('id');
    $statusNow = $request->get('statusNow');

    DB::table('order_essential_oil')
      ->where('id', '=', $idOrder)
      ->update(['Order_Status' => ($statusNow + 1)]);

    echo json_encode(['status' => 200]);
  }
}
