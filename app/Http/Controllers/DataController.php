<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    //
    public function index()
    {
        $locations = \DB::table('locations as a')
        ->select(
            'a.*',
            'b.name_hotline_primary as call_center_name',
            'b.hotline_number_primary as call_center_number',
            'b.name_hotline_secondary as hotline_name',
            'b.hotline_number_secondary as hotline_number',
            // 'c.positive',
            // 'c.updatedAt'
        )
        ->leftJoin('hotline_number as b', 'a.hotline_id', '=', 'b.id')
        // ->leftJoin('daily_data as c', 'a.id', '=', 'c.provinceCode')
        ->distinct('a.name')
        ->orderBy('a.name', 'asc')
        // ->orderBy('c.updatedAt', 'desc')
        // ->orderBy('a.name', 'asc')
        ->limit(35)
        ->get();

        // dd($location);
        return view('pages.data', [
            'locations'          => $locations
        ]);

    }

    public function getDataStatisticProvince(Request $req)
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
        ->orderBy('b.updatedAt', 'asc')
        ->get();

        $oldDataSpread = \DB::table('daily_data as a')
        ->select(
                'a.positive',
                'a.cured',
                'a.death',
                'a.updatedAt as updated_at',
                'b.name as loc_name'
        )
        ->leftJoin('locations as b', 'a.provinceCode', '=', 'b.id')
        ->where('a.updatedAt', '<', date("Y-m-d", strtotime( 'now' )))
        ->orderBy('a.updatedAt', 'asc')
        ->get();

        $dataPercentage = \DB::table('daily_data as a')
        ->select(
            'a.positive',
            'a.cured',
            'a.death',
            'a.updatedAt as updated_at',
            'b.name as loc_name'
        )
        ->leftJoin('locations as b', 'a.provinceCode', '=', 'b.id')
        ->whereNotIn('b.name', ["Indonesia"])
        ->orderBy('a.updatedAt', 'desc')
        ->orderBy('b.name', 'asc')
        ->limit(34)
        ->get();

        return $data = [
            'dataSpread'    => $dataSpread,
            'oldDataSpread' => $oldDataSpread,
            'dataPercentage' => $dataPercentage,
            'statistic' => ($req->filled('query') ? $this->searchProvinceStatistic($req->get('query')) : [])
        ];
    }

    public function searchProvinceStatistic($province_name) 
    {   
        
        $dataSpread = \DB::table('locations as a')
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
            ->where('a.name', 'like', '%'.$province_name.'%')
            ->orderBy('c.updatedAt', 'asc');
        // dd($dataSpread);

        $oldDataSpread = \DB::table('daily_data as a')
            ->select(
                'a.positive',
                'a.cured',
                'a.death',
                'a.updatedAt as updated_at',
                'b.name as loc_name'
            )
            ->leftJoin('locations as b', 'a.provinceCode', '=', 'b.id')
            ->where('a.updatedAt', '<', date("Y-m-d", strtotime( 'now' )))
            ->where('b.name', 'like', '%'.$province_name.'%')
            ->orderBy('a.updatedAt', 'asc')
            ->get();

        if (!$dataSpread->exists()) {
            # code...
            return [];
        }

        $dataSpread = $dataSpread->get();

        // dd($hospitalData);
        return $data = [
            'dataSpread'    => $dataSpread,
            'oldDataSpread' => $oldDataSpread
        ];

    }
}
