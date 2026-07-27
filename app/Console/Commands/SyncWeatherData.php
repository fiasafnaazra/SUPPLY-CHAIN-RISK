<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\WeatherCache;
use App\Services\OpenMeteoService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('weather:sync')]
#[Description('Sinkronisasi data cuaca dari Open-Meteo API')]
class SyncWeatherData extends Command
{
    public function handle(OpenMeteoService $weatherService)
    {
        $countries = Country::all();

        foreach ($countries as $country) {

            try {

                $this->info("Mengambil cuaca {$country->country_name}...");

                $weather = $weatherService->getWeather(
                    $country->latitude,
                    $country->longitude
                );

                WeatherCache::updateOrCreate(

                    [
                        'country_code' => $country->country_code
                    ],

                    [
                        'temperature'   => $weather['temperature'],
                        'precipitation' => $weather['precipitation'],
                        'wind_speed'    => $weather['wind_speed'],
                        'storm_risk'    => $weather['storm_risk'],
                        'fetched_at'    => now(),
                    ]
                );

                $this->info("✔ Berhasil {$country->country_name}");

            } catch (\Exception $e) {

                $this->error("❌ Gagal {$country->country_name}");
                $this->error($e->getMessage());

            }

        }

        $this->info("==============================");
        $this->info("Sinkronisasi cuaca selesai.");
        $this->info("==============================");
    }
}