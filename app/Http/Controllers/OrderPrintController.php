<?php

namespace App\Http\Controllers;

use App\Models\OrderPrint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderPrintController extends Controller
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

    $newOrder = new OrderPrint();
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
    $data = DB::table('order_prints')
      ->orderBy('created_at', 'desc')
      ->get();

    for ($i = 0; $i < $data->count(); $i++) {
      $listProductOrderRaw = json_decode($data[$i]->Order_ListProduct);
      $listProductOrder = [
        'countOrder' => 0,
        'listProduct' => [],
      ];

      foreach ($listProductOrderRaw as $item) {
        $itemProduct = DB::table('print_products')
          ->select(
            'id',
            'PrintProduct_Name',
          )->where('id', '=', $item->idProduct)->get()->first();

        $listProductOrder['countOrder'] += $item->optionPrice;
        array_push($listProductOrder['listProduct'], ['dataProduct' => $itemProduct, 'priceSelect' => $item->optionPrice]);
      }

      $data[$i]->Order_ListProduct = $listProductOrder;
    }

    echo json_encode(['data' => $data]);
  }
}
