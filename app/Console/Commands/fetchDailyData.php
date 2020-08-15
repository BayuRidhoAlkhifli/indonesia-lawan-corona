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
        $caseIndonesia = Http::get('https://data.covid19.go.id/public/api/prov.json');
        $province = Http::get('https://indonesia-covid-19.mathdro.id/api/provinsi');
        
        foreach ($caseIndonesia->json()['list_data'] as $k => $v) {
            $newGov[strtoupper($v['key'])] = $v;
        }

        foreach ($province->json()['data'] as $k => $v) {
            $allCase[$v['kodeProvi']] = 0;
            $allCured[$v['kodeProvi']] = 0;
            $allDeath[$v['kodeProvi']] = 0;

            if (!empty($newGov[strtoupper($v['provinsi'])])) {
                $dailyData[$v['kodeProvi']] = [
                    'provinceCode' => $v['kodeProvi'],
                    'positive' => $newGov[strtoupper($v['provinsi'])]['jumlah_kasus'],
                    'cured' => $newGov[strtoupper($v['provinsi'])]['jumlah_sembuh'],
                    'death' => $newGov[strtoupper($v['provinsi'])]['jumlah_meninggal'],
                    'createdAt' => now()->toDateTimeString()
                ];

                $allCase[$v['kodeProvi']]+=$newGov[strtoupper($v['provinsi'])]['jumlah_kasus'];
                $allCured[$v['kodeProvi']]+=$newGov[strtoupper($v['provinsi'])]['jumlah_sembuh'];
                $allDeath[$v['kodeProvi']]+=$newGov[strtoupper($v['provinsi'])]['jumlah_meninggal'];

                foreach ($newGov[strtoupper($v['provinsi'])]['kelompok_umur'] as $valueByAge) {
                    $ageData[] = [
                        'provinceCode' => $v['kodeProvi'],
                        'age' => $valueByAge['key'],
                        'numberOfCase' => $valueByAge['doc_count'],
                        'createdAt' =>  now()->toDateTimeString()
                    ];
                    empty($byAge[$valueByAge['key']]) ? $byAge[$valueByAge['key']] = $valueByAge['doc_count'] : $byAge[$valueByAge['key']]+=$valueByAge['doc_count'];
                }

                foreach ($newGov[strtoupper($v['provinsi'])]['jenis_kelamin'] as $keyByGender => $valueByGender) {
                    $genderData[] = [
                        'provinceCode' => $v['kodeProvi'],
                        'sex' => $keyByGender,
                        'numberOfCase' => $valueByGender['doc_count'],
                        'createdAt' =>  now()->toDateTimeString()
                    ];
                    empty($byGender[$keyByGender]) ? $byGender[$keyByGender] = $valueByGender['doc_count'] : $byGender[$keyByGender]+=$valueByGender['doc_count'];
                }
            } else {
                $dailyData[$v['kodeProvi']] = [
                    'provinceCode' => 0,
                    'positive' => array_sum($allCase),
                    'cured' => array_sum($allCured),
                    'death' => array_sum($allDeath),
                    'createdAt' => now()->toDateTimeString()
                ];

                foreach ($byAge as $kDataByAge => $vDataByAge) {
                    $ageData[] = [
                        'provinceCode' => 0,
                        'age' => $kDataByAge,
                        'numberOfCase' => $vDataByAge,
                        'createdAt' =>  now()->toDateTimeString()
                    ];
                }

                foreach ($byGender as $kDataByGender => $vDataByGender) {
                    $genderData[] = [
                        'provinceCode' => 0,
                        'sex' => $kDataByGender,
                        'numberOfCase' => $vDataByGender,
                        'createdAt' =>  now()->toDateTimeString()
                    ];
                }
            }
        }
        \DB::table('daily_data')
        ->where('updatedAt', 'like', '%15:00%')
        ->delete();

        \DB::table('daily_data')
        ->insert($dailyData);


        \DB::table('age_data')
        ->insert($ageData);


        \DB::table('gender_data')
        ->insert($genderData);


        \Log::info("SUKSES AMBIL DATA JAM : ".now('Asia/Jakarta')->toDateTimeString());

        return "SUKSES AMBIL DATA JAM : ".now('Asia/Jakarta')->toDateTimeString();

    }
}
