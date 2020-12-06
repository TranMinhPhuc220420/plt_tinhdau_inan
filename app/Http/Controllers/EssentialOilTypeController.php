<?php

namespace App\Http\Controllers;

use App\Models\EssentialOilType;
use Illuminate\Http\Request;

class EssentialOilTypeController extends Controller
{
    public function store(Request $request)
    {
        $name = $request->get('name');

        $essentialOilType = new EssentialOilType();
        $essentialOilType->id = time();
        $essentialOilType->EssentialOilType_Name = $name;
        $essentialOilType->save();

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
        $typeDelete = EssentialOilType::where('id', $id)->get()->first();
        $typeDelete->delete();
    }

    public function getAll()
    {
        echo json_encode(['status' => 200, 'data' => EssentialOilType::all()]);
    }
}
