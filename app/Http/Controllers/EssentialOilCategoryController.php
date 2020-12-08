<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EssentialOilCategoryController extends Controller
{
    private $nameTable = 'essential_oil_categories';

    public function store(Request $request)
    {
        $EssentialOilCategory_Name = $request->get('name');
        $EssentialOilType_id = $request->get('typeProduct_id');
        $dateCreate = date('Y-m-d h:i:s');

        DB::table('essential_oil_categories')->insert([
            'id' => time(),
            'EssentialOilCategory_Name' => $EssentialOilCategory_Name,
            'FkEssentialOilType_id' => $EssentialOilType_id,
            'created_at' => $dateCreate,
            'updated_at' => $dateCreate,
        ]);

        echo json_encode(['status' => 200, 'message' => 'ok']);
    }

    public function getAll()
    {
        $data = DB::table('essential_oil_categories')
            ->select([
                'essential_oil_categories.id',
                'essential_oil_categories.EssentialOilCategory_Name',
                'essential_oil_categories.FkEssentialOilType_id',
                'essential_oil_categories.created_at',
                'essential_oil_categories.updated_at',
                'essential_oil_types.EssentialOilType_Name',
            ])
            ->join('essential_oil_types',
                'essential_oil_categories.FkEssentialOilType_id',
                '=',
                'essential_oil_types.id')
            ->get();

        echo json_encode(['data' => $data]);
    }

    public function delete(Request $request){
        $idDelete = $request->get('id');
        $response = [
            'status' => 200,
            'message' => ''
        ];


        $categoryHasThisID = DB::table('essential_oil_products')
            ->where(
                'FkEssentialOilCategory_id',
                '=',
                $idDelete
            )
            ->get()->count();

        if ($categoryHasThisID == 0) {
            DB::table($this->nameTable)->where('id', '=', $idDelete)->delete();
        } else {
            $response['status'] = 303;
        }

        echo json_encode($response);
    }

    public function edit(Request $request){
        $idCategoryEdit = $request->get('idCategory');
        $nameChange = $request->get('nameChange');
        $typeProduct_idChange = $request->get('typeProduct_idChange');

        DB::table($this->nameTable)
            ->where('id', $idCategoryEdit)
            ->update(
                [
                    'EssentialOilCategory_Name' => $nameChange,
                    'FkEssentialOilType_id' => $typeProduct_idChange
                ]
            );

        echo json_encode(['status' => 200, 'message' => 'ok']);
    }
}
