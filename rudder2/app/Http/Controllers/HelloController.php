<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
#use App\User;
use App\MtbBrandLists;
use App\DtbOrderAllBrand;

class HelloController extends Controller
{
    //
    public function index(Request $request)
    {
        Log::debug('Step-1');
/*
        Log::debug(print_r($request['fromyear'], true));
        Log::debug(print_r($request['frommonth'], true));
        Log::debug(print_r($request['toyear'], true));
        Log::debug(print_r($request['tomonth'], true));
*/
        $dt_from = $request['fromyear'] . '-' . $request['frommonth'] . '-01';
        $dt_to = $request['toyear'] . '-' . $request['tomonth'] . '-31';

        $current_month = null;
        $this_month_counter = null;
        $total_product_max_value = 10000;
        $moving_average_deviations = 7;
        $arrTargetDate = array();
        $arrTotalProduct = array();
        $arrMovingAverage = array();
        $arrMovingAverageTemp = array();
#        print_r ($request['selectedBrands']);
        Log::debug('Step-2');

        $brand_lists = new MtbBrandLists;
#        $value = $user->find(1);
        $value = $brand_lists->get();

        $order_data = new DtbOrderAllBrand;

        Log::debug('Step-3');
        Log::debug(print_r($request['selectedBrands'], true));
        if (empty($request['selectedBrands'])) {
        Log::debug('Step-4');
#                array_push($request['selectedBrands'], 7);
        }
        Log::debug('Step-5');

        if (is_array($request['selectedBrands'])) {
                $arrOrderData = $order_data->whereIn('brand_id', $request['selectedBrands'])
#                                           ->where('year', '=', '2020')->where('month', '=', '5')->where('day', '=', '13')
                                           ->whereBetween('date', [$dt_from, $dt_to])
                                           ->get();
#                Log::debug(print_r($arrOrderData, true));

#                $books = Book::all();
                $data = ['arrOrderData' => $arrOrderData];
#                Log::debug(print_r($arrOrderData['frommonth'], true));

#                return view('hello', $data);

                foreach ($arrOrderData as $key4 => $value4) {
#                        Log::debug("value4 date is " . $value4['date']);
                        array_push($arrTargetDate, $value4['date']);
#                        array_push($arrTotalProduct, floor($value4['total_product']));

                        if ($current_month == $value4['month']) {
                                $this_month_counter ++;
                                $total_amount = end($arrTotalProduct);
                                array_push($arrTotalProduct, $total_amount + floor($value4['total_tax']));

                                if ($this_month_counter < $moving_average_deviations) {
                                        $moving_average_deviations_value = $this_month_counter;
                                } else {
                                        $moving_average_deviations_value = $moving_average_deviations;                                        
                                }

        #                        Log::debug(print_r($arrTotalProduct, true));
                                $arrMovingAverageTemp = array_slice($arrTotalProduct, -1 * $moving_average_deviations_value, $moving_average_deviations_value);
        #                        Log::debug(print_r($arrMovingAverageTemp, true));


                        } else {
                                // 月が変わった
                                $this_month_counter = 1;

                                $current_month = $value4['month'];
                                $total_amount = 0;
                                array_push($arrTotalProduct, $total_amount + floor($value4['total_tax']));
                                $moving_average_deviations_value = 1;
                                $arrMovingAverageTemp = array_slice($arrTotalProduct, -1 * $moving_average_deviations_value, $moving_average_deviations_value);

                        }

                        $moving_average_value = floor(array_sum($arrMovingAverageTemp) / $moving_average_deviations);
                        array_push($arrMovingAverage, $moving_average_value);
                        Log::debug(print_r($arrMovingAverage, true));

#                        array_push($arrTotalProduct, floor($value4['total_tax']));
#                        array_push($arrTotalProduct, $value4['aov']);
                }
#                Log::debug(print_r($arrTargetDate, true));

                $total_product_max_value = floor(max($arrTotalProduct) / 1000000) * 1000000;

#                $test_array = ["テスト1","テスト2", "テスト3"];
#                $test_array = [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6];


#                return view('test.normal',compact('test_array'));


        } else {
                $arrOrderData = $order_data->where('brand_id', '=', '0')
                                           ->get();
                $data = ['arrOrderData' => $arrOrderData];
         
#                return view('hello', $data);
#                $test_array = [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6];

        }

#                $test_array = ["テスト1","テスト2", "テスト3"];

#        print_r ($value);
#        $arr = ['Snome1', 'Snome2', 'Snome3'];
#        return view('hello', compact('value', 'arr'));

#        $test_1 = "テスト1";
#        $test_2 = "テスト2";

#        return view('hello',compact('test_1','test_2'));

#        return view('hello', compact('value', 'value'));

        return view('disp_graph_sales')->with('value', $value)->with('arrOrderData', $arrOrderData)->with('arrTargetDate', $arrTargetDate)->with('arrTotalProduct', $arrTotalProduct)->with('arrMovingAverage', $arrMovingAverage)->with('total_product_max_value', $total_product_max_value);

        $hello = 'Hello World AKQJT';     
#        return view('hello', compact('hello') );
    }

    public function getSalesData(Request $request)
    { // DIの記述必須！

        $name = $request['name'];   // 「名前」の入力値を取り出す
        $email = $request['email']; // 「email」の入力値を取り出す

        return $name . "-" . $email;
    }
}
