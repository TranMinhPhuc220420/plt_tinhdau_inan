<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PrintProductController extends Controller
{
  public function getNameImage($index)
  {
    switch ($index) {
      case 0:
        return 'image0';
      case 1:
        return 'image1';
      case 2:
        return 'image2';
      case 3:
        return 'image3';
      case 4:
        return 'image4';
      case 5:
        return 'image5';
      default:
        return '';
    }
  }

  public function store(Request $request)
  {
    //Get value
    $nameProduct = $request->get('nameProduct');
    $listPrice = $request->get('listPrice');
    $sapo = $request->get('sapo');
    $description = $request->get('description');
    $information = $request->get('information');
    $listImage = $request->get('listImage');
    $lengthListImage = $request->get('lengthListImage');

    //Set value to insert
    $listIDImage = [];
    $dateCreate = date('Y-m-d h:i:s');
    $idProduct = time();

    for ($i = 0; $i < $lengthListImage; $i++) {
      $fileImage = $request->file($this->getNameImage($i));
      $idImage = $idProduct + $i + 1;

      Storage::disk('local')->putFileAs(
        'public/images/print-store/product/' . $idProduct,
        $fileImage,
        $idImage . '.png');

      array_push($listIDImage, [
        'idImage' => $idImage
      ]);
    }

    DB::table('print_products')
      ->insert([
        'id' => $idProduct,
        'PrintProduct_Name' => $nameProduct,
        'PrintProduct_ListImage' => json_encode($listIDImage),
        'PrintProduct_ListPrice' => $listPrice,
        'PrintProduct_Sapo' => $sapo,
        'PrintProduct_Description' => $description,
        'PrintProduct_Info' => $information,
        'created_at' => $dateCreate,
        'updated_at' => $dateCreate,
      ]);

    echo json_encode(['status' => 200, 'message' => 'ok']);
  }

  public function getAll()
  {
    $data = DB::table('print_products')
      ->select()
      ->get();

    echo json_encode(['status' => 200, 'data' => $data]);
  }

  public function update(Request $request)
  {
    //Get data post
    $productEditID = $request->get('idProduct');
    $nameProduct = $request->get('nameProduct');
    $sapoProduct = $request->get('sapo');
    $description = $request->get('description');
    $information = $request->get('information');
    $listImageOld = json_decode($request->get('listImageOld'));
    $lengthListImageNew = $request->get('lengthListImageNew');
    $listPrice = $request->get('listPrice');

    //Get data in database to compare new data
    $productSelectUpdate = DB::table('print_products')
      ->select()
      ->where('id', '=', $productEditID)
      ->get()->first();


    $listIDImage = [];

    //Compare image old
    $listImageOldInDatabase = json_decode($productSelectUpdate->PrintProduct_ListImage);
    $listIdImageNotUse = [];
    foreach ($listImageOldInDatabase as $itemMain) {
      $stillInUse = false;
      if ($listImageOld) {
        foreach ($listImageOld as $itemChild) {
          if ($itemMain->idImage == $itemChild->idImage) {
            $stillInUse = true;
          }
        }
      }

      if ($stillInUse == false) {
        array_push($listIdImageNotUse, [$itemMain->idImage]);
      } else {
        array_push($listIDImage, ['idImage' => $itemMain->idImage]);
      }
    }
    foreach ($listIdImageNotUse as $itemImageRemove) {
      Storage::disk('local')
        ->delete('public/images/print-store/product/' . $productEditID . '/' . $itemImageRemove[0] . '.png');
    }

    //Add new file image
    if (count($listImageOldInDatabase) > 0) {
      $idImageMax = $listImageOldInDatabase[count($listImageOldInDatabase) - 1]->idImage;
    } else {
      $idImageMax = $productEditID;
    }
    for ($i = 0; $i < $lengthListImageNew; $i++) {
      $fileImage = $request->file($this->getNameImage($i));
      $fileName = ++$idImageMax;

      Storage::disk('local')->putFileAs(
        'public/images/print-store/product/' . $productEditID,
        $fileImage,
        $fileName . '.png');

      array_push($listIDImage, [
        'idImage' => $fileName
      ]);
    }


    // Commit update
    DB::table('print_products')
      ->select()
      ->where('id', '=', $productEditID)->update([
        'PrintProduct_Name' => $nameProduct,
        'PrintProduct_Sapo' => $sapoProduct,
        'PrintProduct_Description' => $description,
        'PrintProduct_Info' => $information,
        'PrintProduct_ListImage' => json_encode($listIDImage),
        'PrintProduct_ListPrice' => $listPrice,
        'updated_at' => date('Y-m-d h:i:s')
      ]);


    echo json_encode(['status' => 200, 'message' => 'ok']);
  }

  public function delete(Request $request)
  {
    $idDelete = $request->get('idProduct');

    if ($idDelete) {
      DB::table('print_products')->where('id', '=', $idDelete)->delete();
      Storage::deleteDirectory('public/images/print-store/product/' . $idDelete);
      echo json_encode(['status' => 200, 'message' => 'ok']);
    } else {
      echo json_encode(['status' => 303, 'message' => 'ok']);
    }
  }
}
