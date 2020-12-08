<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EssentialOilProductController extends Controller
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
        //Get data post
        $lengthListImage = $request->get('lengthListImage');
        $nameProduct = $request->get('nameProduct');
        $categoryProduct = $request->get('categoryProduct');
        $priceProduct = $request->get('priceProduct');
        $discountProduct = $request->get('discountProduct');
        $sapoProduct = $request->get('sapoProduct');
        $description = $request->get('description');
        $information = $request->get('information');

        //Data set
        $listIDImage = [];
        $idProduct = time();
        $dateCreate = date('Y-m-d h:i:s');

        for ($i = 0; $i < $lengthListImage; $i++) {
            $fileImage = $request->file($this->getNameImage($i));
            $idImage = $idProduct + $i + 1;

            Storage::disk('local')->putFileAs(
                'public/images/essential-oil/product/' . $idProduct,
                $fileImage,
                $idImage . '.png');

            array_push($listIDImage, [
                'idImage' => $idImage
            ]);
        }

        DB::table('essential_oil_products')
            ->insert([
                'id' => $idProduct,
                'FkEssentialOilCategory_id' => $categoryProduct,
                'EssentialOilProduct_Name' => $nameProduct,
                'EssentialOilProduct_Vote' => 0,
                'EssentialOilProduct_Sapo' => $sapoProduct,
                'EssentialOilProduct_Description' => $description,
                'EssentialOilProduct_Info' => $information,
                'EssentialOilProduct_Price' => $priceProduct,
                'EssentialOilProduct_Discount' => $discountProduct,
                'EssentialOilProduct_ListImage' => json_encode($listIDImage),
                'created_at' => $dateCreate,
                'updated_at' => $dateCreate,
            ]);

        echo json_encode(['status' => 200, 'message' => 'ok']);
    }

    public function getAll()
    {
        $data = DB::table('essential_oil_products')
            ->select([
                'essential_oil_products.id as product_id',
                'essential_oil_products.EssentialOilProduct_Name',
                'essential_oil_products.FkEssentialOilCategory_id',
                'essential_oil_products.EssentialOilProduct_Vote',
                'essential_oil_products.EssentialOilProduct_Sapo',
                'essential_oil_products.EssentialOilProduct_Description',
                'essential_oil_products.EssentialOilProduct_Info',
                'essential_oil_products.EssentialOilProduct_Price',
                'essential_oil_products.EssentialOilProduct_Discount',
                'essential_oil_products.EssentialOilProduct_ListImage',
                'essential_oil_products.created_at',
                'essential_oil_products.updated_at',
                'essential_oil_categories.id as category_id',
                'essential_oil_categories.EssentialOilCategory_Name',
            ])
            ->join('essential_oil_categories',
                'essential_oil_products.FkEssentialOilCategory_id',
                '=',
                'essential_oil_categories.id')
            ->get();

        echo json_encode(['status' => 200, 'data' => $data]);
    }

    public function update(Request $request)
    {
        //Get data post
        $productEditID = $request->get('product_id');
        $categoryProductID = $request->get('categoryProductID');
        $nameProduct = $request->get('nameProduct');
        $priceProduct = $request->get('priceProduct');
        $discountProduct = $request->get('discountProduct');
        $sapoProduct = $request->get('sapoProduct');
        $description = $request->get('description');
        $information = $request->get('information');
        $listImageOld = json_decode($request->get('listImageOld'));
        $lengthListImageNew = $request->get('lengthListImageNew');

        //Get data in database to compare new data
        $productSelectUpdate = DB::table('essential_oil_products')
            ->select([
                'essential_oil_products.id as product_id',
                'essential_oil_products.EssentialOilProduct_Name',
                'essential_oil_products.FkEssentialOilCategory_id',
                'essential_oil_products.EssentialOilProduct_Vote',
                'essential_oil_products.EssentialOilProduct_Sapo',
                'essential_oil_products.EssentialOilProduct_Description',
                'essential_oil_products.EssentialOilProduct_Info',
                'essential_oil_products.EssentialOilProduct_Price',
                'essential_oil_products.EssentialOilProduct_Discount',
                'essential_oil_products.EssentialOilProduct_ListImage',
                'essential_oil_products.created_at',
                'essential_oil_products.updated_at',
                'essential_oil_categories.id as category_id',
                'essential_oil_categories.EssentialOilCategory_Name',
            ])
            ->join('essential_oil_categories',
                'essential_oil_products.FkEssentialOilCategory_id',
                '=',
                'essential_oil_categories.id')
            ->where('essential_oil_products.id', '=', $productEditID)
            ->get()->first();


        $listIDImage = [];

        //Compare image old
        $listImageOldInDatabase = json_decode($productSelectUpdate->EssentialOilProduct_ListImage);
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
                ->delete('public/images/essential-oil/product/' . $productEditID . '/' . $itemImageRemove[0] . '.png');
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
                'public/images/essential-oil/product/' . $productEditID,
                $fileImage,
                $fileName . '.png');

            array_push($listIDImage, [
                'idImage' => $fileName
            ]);
        }


        // Commit update
        DB::table('essential_oil_products')
            ->where('essential_oil_products.id', $productEditID)
            ->update([
                'FkEssentialOilCategory_id' => $categoryProductID,
                'EssentialOilProduct_Name' => $nameProduct,
                'EssentialOilProduct_Vote' => 0,
                'EssentialOilProduct_Sapo' => $sapoProduct,
                'EssentialOilProduct_Description' => $description,
                'EssentialOilProduct_Info' => $information,
                'EssentialOilProduct_Price' => $priceProduct,
                'EssentialOilProduct_Discount' => $discountProduct,
                'EssentialOilProduct_ListImage' => json_encode($listIDImage),
                'updated_at' => date('Y-m-d h:i:s')
            ]);


        echo json_encode(['status' => 200, 'message' => 'ok']);
    }
}
