<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;
use App\Models\NewsCache;
use App\Models\RiskScore;
use App\Services\RiskScoringService;

class SyncRiskScore extends Command
{
    /**
     * Nama command
     */
    protected $signature = 'risk:sync';

    /**
     * Deskripsi command
     */
    protected $description = 'Menghitung Risk Score seluruh negara';

    public function handle()
    {
        $service = new RiskScoringService();

        $countries = Country::with([
            'weather',
            'economic',
            'currencyRate'
        ])->get();

        $this->info('==============================');
        $this->info('Menghitung Risk Score...');
        $this->info('==============================');

        foreach ($countries as $country) {

            // Ambil berita negara tersebut
            $news = NewsCache::where('country_code', $country->country_code)
                        ->get();

            // Jika tidak ada berita negara, gunakan GLOBAL
            if ($news->count() == 0) {
                $news = NewsCache::where('country_code', 'GLOBAL')->get();
            }

            // Hitung score
            $score = $service->calculate(
                $country->weather,
                $country->economic,
                $country->currencyRate,
                $news
            );

            // Simpan ke database
            RiskScore::updateOrCreate(

                [
                    'country_code' => $country->country_code,
                ],

                [
                    'weather_score'   => $score['weather_score'],
                    'inflation_score' => $score['inflation_score'],
                    'currency_score'  => $score['currency_score'],
                    'news_score'      => $score['news_score'],
                    'total_score'     => $score['total_score'],
                    'risk_level'      => $score['risk_level'],
                ]

            );

            $this->info(
                $country->country_name .
                ' => ' .
                $score['total_score'] .
                ' (' .
                $score['risk_level'] .
                ')'
            );
        }

        $this->info('==============================');
        $this->info('Semua Risk Score berhasil dihitung.');
        $this->info('==============================');

        return Command::SUCCESS;
    }
}