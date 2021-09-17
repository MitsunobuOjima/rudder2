<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
/*
        Schema::create('logins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
*/

        Schema::create('logins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->unsignedInteger('year')->comment('ログイン・年');
            $table->unsignedInteger('month')->comment('ログイン・月');
            $table->unsignedInteger('day')->comment('ログイン・日');
            $table->unsignedInteger('hour')->comment('ログイン・時');
            $table->unsignedInteger('minute')->comment('ログイン・分');
            $table->unsignedInteger('second')->comment('ログイン・秒');

            $table->foreign('user_id')->references('id')->on('users');
            $table->index(['year', 'month']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logins');
    }
}
