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
        $provinve = Http::get('https://indonesia-covid-19.mathdro.id/api/provinsi');
        $idCase =  Http::get('https://indonesia-covid-19.mathdro.id/api/');
        $caseData = $provinve->json();
        $idCaseData = $idCase->json();

        for ($i=0; $i < count($caseData["data"]); $i++) {
            # code...

            \Log::info($caseData["data"][$i]);


            if ($i < 34) {
                \DB::table('daily_data')
                ->insert([
                    'provinceCode' => $caseData["data"][$i]["kodeProvi"],
                    'positive' => $caseData["data"][$i]["kasusPosi"],
                    'cured' => $caseData["data"][$i]["kasusSemb"],
                    'death' => $caseData["data"][$i]["kasusMeni"],
                    'createdAt' => now('Asia/Jakarta')->toDateTimeString()
                ]);
            } else {
                # code...
                // dd("false");
                \DB::table('daily_data')
                ->insert([
                    'provinceCode' => $caseData["data"][$i]["kodeProvi"],
                    'positive' => $idCaseData["jumlahKasus"],
                    'cured' => $idCaseData["sembuh"],
                    'death' => $idCaseData["meninggal"],
                    'createdAt' => now('Asia/Jakarta')->toDateTimeString()
                ]);
            }
        }

        

        \Log::info("SUKSES AMBIL DATA JAM : ".now('Asia/Jakarta')->toDateTimeString());
        \Log::info($provinve->json());

    }
}
