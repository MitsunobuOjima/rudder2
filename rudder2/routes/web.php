<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('hello', 'HelloController');
Route::post('hello', 'HelloController@index')->name('index');
/*
Route::post('hello', 'HelloController@getdata')->name('getdata');
*/
Route::get('login_count', 'LoginCountController@index');
Route::get('ajax/login_count', 'LoginCountController@ajax_index');
/*
Route::get('ajax/login_count', 'resDataController@ajax_index');
*/