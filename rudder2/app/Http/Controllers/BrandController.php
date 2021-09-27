<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\MtbBrandLists;
use App\DtbOrderAllBrand;
use App\Http\Requests\ItemRequest;
use App\Item;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $arrBrandData = array();
        $brandLists = new MtbBrandLists;
        $brand_list = $brandLists->get();

        if ($request['select_brand']) {
            $arrBrandData = $brandLists->where('id', '=', $request['select_brand'])
                                       ->get();
        }

        return view('ctrl_brand')->with('brand_list', $brand_list)->with('arrBrandData', $arrBrandData);
    }

    public function edit(Request $request)
    {
        $arrBrandData = array();
        $brandLists = new MtbBrandLists;
        $brand_list = $brandLists->get();

        $arrBrandData = $brandLists->where('id', '=', $request['id'])
                                   ->get();

        $target_brand = $brandLists::findOrFail($request['id']);
        $target_brand->timestamps         = false;
        $target_brand->name               = $request['name'];
        $target_brand->code               = $request['code'];
        $target_brand->team               = $request['team'];
#        $target_brand->sort               = $request['sort'];
        $target_brand->coefficient        = $request['coefficient'];
#        $target_brand->del_flg            = $request['del_flg'];
        $target_brand->fiscal_start_month = $request['fiscal_start_month'];
        $target_brand->update_date        = date("Y-m-d H:i:s");
        $target_brand->save();

        return view('ctrl_brand')->with('brand_list', $brand_list)->with('arrBrandData', $arrBrandData);
    }
}
