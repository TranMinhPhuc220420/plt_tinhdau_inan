<?php

namespace App\Http\Controllers;

use App\Models\EssentialOilType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EssentialOilTypeController extends Controller
{
    public function store(Request $request)
    {
        $fileImage = $request->file('fileImage');
        $name = $request->get('name');
        $idType = time();

        $essentialOilType = new EssentialOilType();
        $essentialOilType->id = $idType;
        $essentialOilType->EssentialOilType_Name = $name;
        $essentialOilType->EssentialOilType_Image = $idType;
        $essentialOilType->save();

        Storage::disk('local')->putFileAs(
            'public/images/essential-oil/type/' . $idType,
            $fileImage,
            $idType . '.png');

        echo json_encode(['status' => 200, 'message' => 'ok']);
    }

    public function edit(Request $request){
        $id = $request->get('id');
        $nameChange = $request->get('nameChange');

        $typeEdit = EssentialOilType::where('id', $id)->get()->first();

        if($typeEdit){
            $typeEdit->id = $id;
            $typeEdit->EssentialOilType_Name = $nameChange;
            $typeEdit->save();

            echo json_encode(['status' => 200, 'message' => 'ok']);
        }else{
            echo json_encode(['status' => 200, 'message' => 'error']);
        }
    }

    public function delete(Request $request){
        $id = $request->get('id');
        $response = [
            'status' => 200,
            'message' => ''
        ];

        $categoryHasThisID = DB::table('essential_oil_categories')
            ->where(
                'FkEssentialOilType_id',
                '=',
                $id
            )
            ->get()->count();

        if($categoryHasThisID == 0){
            $typeDelete = EssentialOilType::where('id', $id)->first();
            $typeDelete->delete();
            Storage::deleteDirectory('public/images/essential-oil/type/' . $id);
        }else{
            $response['status'] = 303;
        }

        echo json_encode($response);
    }

    public function getAll()
    {
        $dataMain = DB::table('essential_oil_types')
            ->select()->get();

        foreach ($dataMain as $item) {
            $count = DB::table('essential_oil_categories')
                ->select([
                    DB::raw('COUNT(essential_oil_categories.FkEssentialOilType_id) as category')
                ])
                ->where(
                    'FkEssentialOilType_id',
                    '=',
                    $item->id
                )
                ->get();

            $item->count = $count;
        }

        echo json_encode(['status' => 200, 'data' => $dataMain]);
    }
}
