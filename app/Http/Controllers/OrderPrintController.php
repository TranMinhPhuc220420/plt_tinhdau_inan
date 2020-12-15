<?php

namespace App\Http\Controllers;

use App\Models\OrderPrint;
use Illuminate\Http\Request;

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

  public function getAll(){

  }
}
