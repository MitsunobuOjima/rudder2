<?php

use Illuminate\Database\Seeder;

class LoginsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $today = today();

        for($i = 0 ; $i < 500 ; $i++) {

            $random_days = rand(1, 100);
            $random_hours = rand(1, 23);
            $dt = $today->copy()
                ->subDays(rand(1, 100))  // -1〜100日前
                ->addHours(rand(1, 23))  // +1〜23時間
                ->addMinutes(rand(1, 59))  // +1〜23分
                ->addSeconds(rand(1, 59));  // +1〜23秒

            $login = new \App\Login();
            $login->user_id = 1;    // テストなのでユーザーIDは "1" で固定
            $login->year = $dt->year;
            $login->month = $dt->month;
            $login->day = $dt->day;
            $login->hour = $dt->hour;
            $login->minute = $dt->minute;
            $login->second = $dt->second;
            $login->save();

        }
    }
}
