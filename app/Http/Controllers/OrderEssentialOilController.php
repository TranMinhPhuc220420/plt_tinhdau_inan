<?php

namespace App\Http\Controllers;

use App\Models\OrderEssentialOil;
use Illuminate\Http\Request;

class OrderEssentialOilController extends Controller
{
  public function store(Request $request)
  {
    //Get value param
    $listIDProduct = $request->get('listIDProduct');
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
    $newOrder->Order_ListProductID = $listIDProduct;
    $newOrder->Order_Note = $userNote;
    $newOrder->save();

    echo json_encode(['status' => 200, 'message' => 'ok']);
  }
}
