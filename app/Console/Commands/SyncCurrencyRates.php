<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;
use App\Models\CurrencyRate;
use App\Services\ExchangeRateService;

class SyncCurrencyRates extends Command
{
    protected $signature = 'currency:sync';

    protected $description = 'Sinkronisasi kurs mata uang';

    public function handle()
    {
        $service = new ExchangeRateService();

        $rates = $service->getRates();

        if (!$rates) {
            $this->error('Gagal mengambil data kurs.');
            return Command::FAILURE;
        }

        $countries = Country::all();

        foreach ($countries as $country) {

            // Lewati jika negara tidak punya kode mata uang
            if (empty($country->currency)) {
                continue;
            }

            // Lewati jika kurs tidak ditemukan
            if (!isset($rates[$country->currency])) {
                continue;
            }

            CurrencyRate::updateOrCreate(
                [
                    'country_code' => $country->country_code,
                ],
                [
                    'country_code'  => $country->country_code,
                    'currency_code' => $country->currency,
                    'exchange_rate' => $rates[$country->currency],
                    'fetched_at'    => now(),
                ]
            );

            $this->info("✔ {$country->country_name} berhasil.");
        }

        $this->info('======================');
        $this->info('Sinkronisasi selesai.');
        $this->info('======================');

        return Command::SUCCESS;
    }
}