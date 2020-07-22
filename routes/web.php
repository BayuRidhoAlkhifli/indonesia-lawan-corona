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

// Route::get('news', function () {
//     return view('pages.news');
// });

Route::get('', 'HomeController@index')->name("home");
Route::get('news', 'HomeController@news')->name("newsPage");
Route::get('data', 'DataController@index')->name("dataPage");

Route::get('data-spread', 'HomeController@getDataSpread')->name("get.dataSpread");
Route::get('search-province/{province_name}', 'HomeController@searchProvince')->name("get.provinceName");
Route::get('data-statistic', 'DataController@getDataStatisticProvince')->name("get.dataStatistic");


Route::get('/kon', function () {
    $data = \Http::get('https://indonesia-covid-19.mathdro.id/api/provinsi');

    $data = $data->json();
    $sum = 0;
    foreach($data['data'] as $v){
        $sum+=$v['kasusPosi'];
    }

    dd($sum);
});


// Route::get('/home', 'HomeController@getHotlineNumber')->name('getHotline');
