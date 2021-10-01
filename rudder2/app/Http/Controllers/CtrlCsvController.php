<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\DtbOrderAllBrand;

class CtrlCsvController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('ctrl_csv');
    }

    public function import(Request $request)
    {
        Log::debug('I am in import of CtrlCsvController');

        //フルパスの取得
#        $fullpath = __FILE__;
#        Log::debug('fullpath is ' . $fullpath);
        //ディレクトリパスの取得
#        $dirpath = dirname(__FILE__);
#        Log::debug('dirpath is ' . $dirpath);

        #CSVファイル置き場の絶対パス
        # /home/rudder_op_user/rudder/batch_dev/order_summary/2021

        // アップロードファイルのファイルパスを取得
#        $file_path = $request->file('csv')->path();
#        $file_path = '/storage/tmp_csv/mk_20210102.csv';
#        ↓権限的にアクセスできない
#        $file_path = '/home/rudder_op_user/rudder/batch_dev/order_summary/2021/mk_20210102.csv';
        $file_path = dirname(__FILE__) . '/../../../storage/tmp_csv/mk_20210930.csv';;
        Log::debug('file_path is ' . $file_path);

        // CSV取得
        $file = new \SplFileObject($file_path);
        $file->setFlags(
            \SplFileObject::READ_CSV | 
            \SplFileObject::READ_CSV | 
            \SplFileObject::READ_AHEAD | 
            \SplFileObject::SKIP_EMPTY | 
            \SplFileObject::DROP_NEW_LINE 
        );

        // 一行ずつ処理
        foreach ($file as $key => $line)
        {
            Log::debug(print_r($line, true));

            $date                       = $line[0];
            $brand_id                   = $line[1];
            $cv                         = $line[2];
            $men                        = $line[3];
            $women                      = $line[4];
            $total_tax                  = $line[5];
            $everage                    = $line[6];
            $total_product              = $line[7];
            $total_product_tax          = $line[8];
            $coupon                     = $line[9];
            $number_item                = $line[10];
            $total_sale_amount_wo_tax   = $line[11];
            $total_proper_amount_wo_tax = $line[12];

            if ($key == 0) {
                continue;
            }

            if ($date == "期間") {
                continue;
            }

            if ($date == "合計") {
                continue;
            }

            $arrDateElm = explode("-", $line[0]);
            $trimed_year = $arrDateElm[0];
            $trimed_month = $arrDateElm[1];
            $trimed_day = $arrDateElm[2];

            $cv = (int) $line[2];
            if ($cv > 0) {
                $aov = floor((int) $line[7] / $cv);
            } else {
                $aov = 0;
            }

            if (strlen($date)) {
                DtbOrderAllBrand::updateOrCreate(
                    ['brand_id' => $brand_id, 'date' => $date],
                    ['brand_id' => $brand_id, 'date' => $date, 'year' => $trimed_year, 'month' => $trimed_month, 'day' => $trimed_day, 'cv' => $cv, 'aov' => $aov, 'men' => $men, 'women' => $women, 'total_tax' => $total_tax, 'everage' => $everage, 'total_product' => $total_product, 'total_product_tax' => $total_product_tax, 'coupon' => $coupon, 'number_item' => $number_item]
                );
            } else {
            }
        }

        return view('ctrl_csv');
    }
}
