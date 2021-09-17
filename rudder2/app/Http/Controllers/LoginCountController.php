<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginCountController extends Controller
{
    //
    public function index() {

        return view('login_count');

    }

    public function ajax_index(Request $request) {

        $year = date('Y');
        $month = date('m');

        if($request->filled('year', 'month')) {

            $year = $request->year;
            $month = $request->month;

        }

        $logins = \App\Login::select('hour', \DB::raw('COUNT(id) AS login_count'))
            ->where('year', $year)
            ->where('month', $month)
            ->groupBy('hour')
            ->pluck('login_count', 'hour');

        $counts = [];

        for($i = 0 ; $i < 24 ; $i++) {

            $counts[$i] = $logins->get($i, 0);  // 存在しない時間は "0" 回

        }

        return $counts;

    }
}
