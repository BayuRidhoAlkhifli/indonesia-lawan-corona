<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use DB;

class fetchDailyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ambil data dari API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $case = Http::get('https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/COVID19_Indonesia_per_Provinsi/FeatureServer/0/query?where=1%3D1&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&resultType=none&distance=0.0&units=esriSRUnit_Meter&returnGeodetic=false&outFields=*&returnGeometry=true&featureEncoding=esriDefault&multipatchOption=xyFootprint&maxAllowableOffset=&geometryPrecision=&outSR=&datumTransformation=&applyVCSProjection=false&returnIdsOnly=false&returnUniqueIdsOnly=false&returnCountOnly=false&returnExtentOnly=false&returnQueryGeometry=false&returnDistinctValues=false&cacheHint=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&having=&resultOffset=&resultRecordCount=&returnZ=false&returnM=false&returnExceededLimitFeatures=true&quantizationParameters=&sqlFormat=standard&f=pjson&token=');
        $caseData = $case->json();
        $positive = 0;
        $cured = 0;
        $death = 0;

        for ($i=0; $i < count($caseData["features"]); $i++) {
            # code...
            $positive += $caseData["features"][$i]["attributes"]["Kasus_Posi"];
            $cured += $caseData["features"][$i]["attributes"]["Kasus_Semb"];
            $death += $caseData["features"][$i]["attributes"]["Kasus_Meni"];

            // \Log::info($positive);
            // dd($caseData["features"][$i]["attributes"]);


            if ($i < 34) {
                \DB::table('daily_data')
                ->insert([
                    'provinceCode' => $caseData["features"][$i]["attributes"]["Kode_Provi"],
                    'positive' => $caseData["features"][$i]["attributes"]["Kasus_Posi"],
                    'cured' => $caseData["features"][$i]["attributes"]["Kasus_Semb"],
                    'death' => $caseData["features"][$i]["attributes"]["Kasus_Meni"],
                    'createdAt' => now('Asia/Jakarta')->toDateTimeString()
                ]);
            } else {
                # code...
                // dd("false");
                \DB::table('daily_data')
                ->insert([
                    'provinceCode' => $caseData["features"][$i]["attributes"]["Kode_Provi"],
                    'positive' => $positive,
                    'cured' => $cured,
                    'death' => $death,
                    'createdAt' => now('Asia/Jakarta')->toDateTimeString()
                ]);
            }
        }


        

        \Log::info("SUKSES AMBIL DATA JAM : ".now('Asia/Jakarta')->toDateTimeString());
        // \Log::info($case->json());


    }
}
