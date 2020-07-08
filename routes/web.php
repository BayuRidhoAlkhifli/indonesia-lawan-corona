<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/kon', function(){
    $test = \DB::table('json_data')->get();
    dd($test);
});

// Route::get('/home', 'HomeController@getHotlineNumber')->name('getHotline');
