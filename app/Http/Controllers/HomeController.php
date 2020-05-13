<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $data = \DB::table('locations as a')
        ->select(
            'a.*',
            'b.name_hotline_primary as call_center_name',
            'b.hotline_number_primary as call_center_number',
            'b.name_hotline_secondary as hotline_name',
            'b.hotline_number_secondary as hotline_number'
        )
        ->leftJoin('hotline_number as b', 'a.hotline_id', '=', 'b.id')
        ->get();

        return view('pages.home', [
            'data'      => $data
        ]);
    }

}
