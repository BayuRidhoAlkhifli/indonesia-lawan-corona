<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataSpreadController extends Controller
{
    //
    public function getHotlineNumber(){

        $data = \DB::table('hotline_number')
        ->where('id',1)
        ->get();

        return view('pages.home',[
            'name_hotline_primary'      => $data->name_hotline_primary,

        ]);
    }
}
