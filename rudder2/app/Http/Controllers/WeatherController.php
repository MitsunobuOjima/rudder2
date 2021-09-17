<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Senser;
use Yajra\DataTables\DataTables;
use Log;


class WeatherController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    Log::info("WeatherController index");
    return view('weather.index');
  }
 
  public function tabledata(Request $request) {
    Log::info("WeatherController tabledata");
     
    $value = $request->input('datedata');
    Log::info("WeatherController tabledata: " . $value);
 
    $from = date('2021-03-31 00:00:00');
    $to = date('2021-03-31 23:59:59');
    $sensers = Senser::whereBetween('created_at', [$from, $to])
            ->groupBy(\DB::raw('substr(created_at, 1, 13)'))
            ->get();
    $timex = substr($sensers[1]["created_at"], 1, 13);
//    Log::info(substr($sensers[1]["created_at"], 1, 13) . "00");
 
    for ($i = 0; $i < count($sensers); $i++) {
      $sensers[$i]["created_at"] = substr($sensers[$i]["created_at"], 1, 13) . "00:00";
      $sensers[$i]["temperature"] = round($sensers[$i]["temperature"], 1);
      $sensers[$i]["humidity"] = round($sensers[$i]["humidity"], 1);
      $sensers[$i]["pressure"] = round($sensers[$i]["pressure"], 1);
    }
 
    return Datatables::of($sensers)
                    ->make(true);
  }
 
  public function chartdata(Request $request) {
    Log::info("WeatherController chartdata");
 
    $value = $request->input('datedata');
//    Log::info("WeatherController chartdata: " . $value);
//      $yesterday_date = $_GET['yesterday_date'];
//  $yesterday_date = '2016/07/29'; 
    $value = '2021-03-31';
 
    $from = date($value . ' 00:00:00');
    $to = date($value . ' 23:59:59');
    $sensers = Senser::select(['created_at', 'temperature', 'humidity', 'pressure'])
            ->whereBetween('created_at', [$from, $to])
            ->groupBy(\DB::raw('substr(created_at, 1, 13)'))
            ->get();
 
//    Log::info($sensers);
//    Log::info($sensers[2]["temperature"]);
 
    $data = array();
    for ($i = 0; $i < count($sensers); $i++) {
      $data[0][$i] = round($sensers[$i]["temperature"], 1);
      $data[1][$i] = round($sensers[$i]["humidity"], 1);
      $data[2][$i] = round($sensers[$i]["pressure"], 1);
    }
    //   Log::info($data);
    //header('Content-type: application/json; charset=UTF-8');
    return json_encode($data);
  }
