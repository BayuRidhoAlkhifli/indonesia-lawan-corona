<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;


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

// Route::get('/', function () {
//     return view('layout.hero');
// });

Route::get('', 'HomeController@index');
Route::get('data-spread', 'HomeController@getDataSpread')->name("get.dataSpread");

Route::get('search-province/{province_name}', 'HomeController@searchProvince')->name("get.provinceName");

// Route::get('/home', 'HomeController@getHotlineNumber')->name('getHotline');
