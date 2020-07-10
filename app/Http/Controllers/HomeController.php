<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index() 
    {
        $data = \DB::table('locations as a')
        ->select(
            'a.*',
            'b.name_hotline_primary as call_center_name',
            'b.hotline_number_primary as call_center_number',
            'b.name_hotline_secondary as hotline_name',
            'b.hotline_number_secondary as hotline_number',
            'c.positive'
        )
        ->leftJoin('hotline_number as b', 'a.hotline_id', '=', 'b.id')
        ->leftJoin('daily_data as c', 'a.id', '=', 'c.provinceCode')
        ->orderBy('c.positive', 'desc')
        ->get();

        return view('pages.home', [
            'data'      => $data
        ]);
    }

    public function getDataSpread()
    {
        $data = \DB::table('locations as a')
        ->select(
                'a.name',
                'b.positive',
                'b.cured',
                'b.death',
                'b.updatedAt as updated_at',
                'c.name_hotline_primary as call_center_name',
                'c.hotline_number_primary as call_center_number',
                'c.name_hotline_secondary as hotline_name',
                'c.hotline_number_secondary as hotline_number'

        )
        ->leftJoin('daily_data as b', 'a.id', '=', 'b.provinceCode')
        ->leftJoin('hotline_number as c', 'a.hotline_id', '=', 'c.id')
        // ->whereDate('b.updatedAt', now())
        ->orderBy('b.updatedAt', 'desc')
        ->limit(35)
        ->get();

        return $data;
    }

    public function searchProvince($province_name) 
    {   
        $data = \DB::table('locations as a')
            ->select(
                'a.*',
                'b.name_hotline_primary as call_center_name',
                'b.hotline_number_primary as call_center_number',
                'b.name_hotline_secondary as hotline_name',
                'b.hotline_number_secondary as hotline_number',
                'c.positive',
                'c.cured',
                'c.death',
            )
            ->leftJoin('hotline_number as b', 'a.hotline_id', '=', 'b.id')
            ->leftJoin('daily_data as c', 'a.id', '=', 'c.provinceCode')
            ->where('name', 'like', '%'.$province_name.'%');

            if (!$data->exists()) {
                # code...
                return [];
            }
        
        $data = $data->get();

        return $data;
        // dd($data);

    }
}
