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
        $response = Http::get('https://indonesia-covid-19.mathdro.id/api/provinsi');
        \App\Models\JsonData::create(['json' => json_encode($response->json()), 'date_time' => now('Asia/Jakarta')->toDateTimeString()]);
        \Log::info("SUKSES AMBIL DATA JAM : ".now('Asia/Jakarta')->toDateTimeString());
        \Log::info($response->json());

    }
}
