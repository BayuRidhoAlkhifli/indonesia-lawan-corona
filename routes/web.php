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


// Route::get('/home', 'HomeController@getHotlineNumber')->name('getHotline');
Route::get('/kon', function () {
    $caseindonesia = \Http::get('https://data.covid19.go.id/public/api/prov.json');
    $province = Http::get('https://indonesia-covid-19.mathdro.id/api/provinsi');
    $positive = 0;
    $cured = 0;
    $death = 0;


    $caseData = $province->json();

    for ($i=0; $i < count($caseData["data"]); $i++) {
        
        if ($i < 34) {
            # code...
            $positive += $caseindonesia["list_data"][$i]["jumlah_kasus"];
            $cured += $caseindonesia["list_data"][$i]["jumlah_sembuh"];
            $death += $caseindonesia["list_data"][$i]["jumlah_meninggal"];

            if ($caseData["data"][$i]["provinsi"] != "Indonesia" && $caseindonesia["list_data"][$i]["key"] == strtoupper($caseData["data"][$i]["provinsi"])) {
                # code...
                \DB::table('daily_data')
                ->insert([
                    'provinceCode' => $caseData["data"][$i]["kodeProvi"],
                    'positive' => $caseindonesia["list_data"][$i]["jumlah_kasus"],
                    'cured' => $caseindonesia["list_data"][$i]["jumlah_sembuh"],
                    'death' => $caseindonesia["list_data"][$i]["jumlah_meninggal"],
                    'createdAt' => now('Asia/Jakarta')->toDateTimeString()
                ]);
            }
        } else {
            \DB::table('daily_data')
            ->insert([
                'provinceCode' => $caseData["data"][$i]["kodeProvi"],
                'positive' => $positive,
                'cured' => $cured,
                'death' => $death,
                'createdAt' => now('Asia/Jakarta')->toDateTimeString()
            ]);

        }      

    }
    
    // $sum = 0;
    // foreach ($data['data'] as $v) {
    //     $sum+=$v['kasusPosi'];
    // }

    // dd($positive,$cured,$death);
    \Log::info("SUKSES AMBIL DATA JAM : ".now('Asia/Jakarta')->toDateTimeString());

});

