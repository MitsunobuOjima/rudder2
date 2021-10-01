<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\MtbBrandLists;
use App\DtbOrderAllBrand;
use App\DtbBrandBudget;
use App\Http\Requests\ItemRequest;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brand_budget = null;
        $selected_year = date('Y');
        $brand_budget_year = null;
        $fiscal_start_month = null;

        $arrBrandData = array();
        $brandLists = new MtbBrandLists;
        $brand_list = $brandLists->get();
        if ($request['select_brand']) {
            $arrBrandData = $brandLists->where('id', '=', $request['select_brand'])
                                       ->get();
        }

        $arrBudget = array();
        $objBrandBudgets = new DtbBrandBudget;
        $arrBudget = $objBrandBudgets->where('brand_id', '=', $request['select_brand'])
                                      ->where('year', '=', 2021)
                                      ->orderBy('rank', 'asc')
                                      ->get();

#Log::debug(print_r($arrBudget, true));

        return view('ctrl_brand')->with('brand_list', $brand_list)->with('arrBrandData', $arrBrandData)->with('arrBudget', $arrBudget)->with('brand_id', $request['select_brand'])->with('brand_budget', $brand_budget)->with('selected_year', $selected_year)->with('brand_budget_year', $brand_budget_year);
    }

    public function edit(Request $request)
    {
        $brand_budget = null;
        $selected_year = date('Y');
        $brand_budget_year = null;
        $fiscal_start_month = null;

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

        $arrBudget = array();
        $objBrandBudgets = new DtbBrandBudget;
        $arrBudget = $objBrandBudgets->where('brand_id', '=', $request['id'])
                                      ->where('year', '=', 2021)
                                      ->orderBy('rank', 'asc')
                                      ->get();

        return view('ctrl_brand')->with('brand_list', $brand_list)->with('arrBrandData', $arrBrandData)->with('arrBudget', $arrBudget)->with('brand_id', $request['id'])->with('selected_year', $selected_year)->with('brand_budget_year', $brand_budget_year);
    }

    public function select_year(Request $request)
    {
        Log::debug('I am in select_year of BrandController');

        $brand_budget = null;
        $selected_year = date('Y');
        $brand_budget_year = null;
        $fiscal_start_month = null;

        $arrBrandData = array();
        $brandLists = new MtbBrandLists;
        $brand_list = $brandLists->get();
        if ($request['select_brand']) {
            $arrBrandData = $brandLists->where('id', '=', $request['select_brand'])
                                       ->get();
        }

        if ($request['selected_year']) {
            $selected_year = $request['selected_year'];
        }

        $arrBudget = array();
        $objBrandBudgets = new DtbBrandBudget;

        foreach ($arrBrandData as $key3 => $value3) {
            $fiscal_start_month = $value3['fiscal_start_month']; // このブランドの期首開始月を取得
        }
        // 年度予算を取得
        $arrBrandBudgetYear = $objBrandBudgets->where('brand_id', '=', $request['select_brand'])
                                      ->where('year', '=', $selected_year)
                                      ->where('month', '=', $fiscal_start_month)
                                      ->get();
        foreach($arrBrandBudgetYear as $key4 => $value4) {
            $brand_budget_year = $value4['brand_budget_year']; // このブランドの期首開始月を取得            
        }
#        Log::debug('brand_budget_year is ' . $brand_budget_year);
#        Log::debug('selected_year is ' . $selected_year);

        // 月別予算の取得
        $arrBudget = $objBrandBudgets->where('brand_id', '=', $request['select_brand'])
                                      ->where('year', '=', $selected_year)
                                      ->orderBy('rank', 'asc')
                                      ->get();

        if (!count($arrBudget)) {
            // まだ当年の月別予算が未登録なので、Viewに渡すデータが用意できないからbrand_id = 0の雛形データを改めて取得する
            $arrBudget = $objBrandBudgets->where('brand_id', '=', 0)
                                          ->orderBy('rank', 'asc')
                                          ->get();
        }

Log::debug(print_r($_POST, true));

        return view('ctrl_brand')->with('brand_list', $brand_list)->with('arrBrandData', $arrBrandData)->with('arrBudget', $arrBudget)->with('brand_id', $request['select_brand'])->with('brand_budget', $brand_budget)->with('selected_year', $selected_year)->with('brand_budget_year', $brand_budget_year);
    }

    public function edit_budget(Request $request)
    {
        Log::debug('I am in edit_budget of BrandController');

        $brand_budget = null;
        $selected_year = date('Y');
        $brand_budget_year = null;
        $fiscal_start_month = null;

        $arrBrandData = array();
        $brandLists = new MtbBrandLists;
        $brand_list = $brandLists->get();

        if ($request['selected_year']) {
            $selected_year = $request['selected_year'];
        }

        $arrBudget = array();

        if ($request['select_brand']) {
            $arrBrandData = $brandLists->where('id', '=', $request['select_brand'])
                                       ->get();

            $objBrandBudgets = new DtbBrandBudget;
            foreach ($arrBrandData as $key3 => $value3) {
                $fiscal_start_month = $value3['fiscal_start_month']; // このブランドの期首開始月を取得
            }

            Log::debug("request->brand_budget_year is " . $request->brand_budget_year);
            $brand_budget_year = (int) $request->brand_budget_year;

            // 月別予算(brand_budget_month)の登録・更新
            foreach ($request as $key1 => $value1) {
                if ($key1 == 'request') {
                    foreach ($value1 as $key2 => $value2) {
                        if (preg_match('/brand_budget_month/', $key2)) {
                            $month = (int) preg_replace('/brand_budget_month/', '', $key2);
                            $brand_budget_month = (int) $value2;
#Log::debug('month is ' . $month . ', brand_budget_month is ' . $brand_budget_month);

                            if ($month < $fiscal_start_month) {
                                $rank = 12 - ($fiscal_start_month - $month) + 1;
                            } elseif ($month > $fiscal_start_month) {
                                $rank = $month - $fiscal_start_month + 1;
                            } else {
                                $rank = 1;
                            }

                            if ($request->selected_year) {
                                if ($month >= 1 && $month <= 12) {
                                    if ($month == $fiscal_start_month) {
                                        DtbBrandBudget::updateOrCreate(
                                            ['brand_id' => $request['select_brand'], 'year' => $request->selected_year, 'month' => $month],
                                            ['brand_budget_month' => $brand_budget_month, 'rank' => $rank, 'brand_budget_year' => $request->brand_budget_year]
                                        );
                                    } else {
                                        DtbBrandBudget::updateOrCreate(
                                            ['brand_id' => $request['select_brand'], 'year' => $request->selected_year, 'month' => $month],
                                            ['brand_budget_month' => $brand_budget_month, 'rank' => $rank]
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
#Log::debug(print_r($_POST, true));
        $arrBudget = $objBrandBudgets->where('brand_id', '=', $request['select_brand'])
                                      ->where('year', '=', 2021)
                                      ->orderBy('rank', 'asc')
                                      ->get();

        return view('ctrl_brand')->with('brand_list', $brand_list)->with('arrBrandData', $arrBrandData)->with('arrBudget', $arrBudget)->with('brand_id', $request['select_brand'])->with('brand_budget', $brand_budget)->with('selected_year', $selected_year)->with('brand_budget_year', $brand_budget_year);
    }
}
