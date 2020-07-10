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
            'c.positive',
            'c.updatedAt'
        )
        ->leftJoin('hotline_number as b', 'a.hotline_id', '=', 'b.id')
        ->leftJoin('daily_data as c', 'a.id', '=', 'c.provinceCode')
        ->orderBy('c.updatedAt', 'desc')
        ->orderBy('c.positive', 'desc')
        ->limit(35)
        ->get();


        return view('pages.home', [
            'data'          => $data
        ]);
    }

    public function getDataSpread()
    {
        $dataSpread = \DB::table('locations as a')
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

        $hospitalData = \DB::table('referral_hospital as a')
        ->select(
            'a.*',
            'b.name as loc_name'
        )
        ->leftJoin('locations as b', 'a.location_id', '=', 'b.id')
        ->get();


        return $data = [
            'dataSpread'    => $dataSpread,
            'hospitalData'  => $hospitalData
        ];
    }

    public function searchProvince($province_name) 
    {   
        $data = \DB::table('locations as a')
            ->select(
                'a.name',
                'b.name_hotline_primary as call_center_name',
                'b.hotline_number_primary as call_center_number',
                'b.name_hotline_secondary as hotline_name',
                'b.hotline_number_secondary as hotline_number',
                'c.*'
            )
            ->leftJoin('hotline_number as b', 'a.hotline_id', '=', 'b.id')
            ->leftJoin('daily_data as c', 'a.id', '=', 'c.provinceCode')
            ->where('name', 'like', '%'.$province_name.'%')
            ->orderBy('c.updatedAt', 'desc')
            ->limit(1);

            if (!$data->exists()) {
                # code...
                return [];
            }
        
        $data = $data->get();

        return $data;
        // dd($data);

    }
}
