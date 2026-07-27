<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenMeteoService
{
    protected string $baseUrl = 'https://api.open-meteo.com/v1';

    public function getWeather($latitude, $longitude)
    {
        $response = Http::timeout(30)->get(
            "{$this->baseUrl}/forecast",
            [
                'latitude'  => $latitude,
                'longitude' => $longitude,
                'current'   => 'temperature_2m,precipitation,wind_speed_10m,weather_code',
            ]
        );

        if (!$response->successful()) {
            return null;
        }

        $current = $response->json()['current'];

        $temperature = $current['temperature_2m'] ?? null;
        $precipitation = $current['precipitation'] ?? null;
        $windSpeed = $current['wind_speed_10m'] ?? null;
        $weatherCode = $current['weather_code'] ?? null;

        return [

            'temperature' => $temperature,

            'precipitation' => $precipitation,

            'wind_speed' => $windSpeed,

            'weather_code' => $weatherCode,

            'storm_risk' => $this->getStormRisk($windSpeed, $weatherCode),

        ];
    }

    public function getStormRisk($windSpeed, $weatherCode)
    {
        if ($windSpeed >= 60 || in_array($weatherCode, [95, 96, 99])) {
            return 'High';
        }

        if ($windSpeed >= 30) {
            return 'Medium';
        }

        return 'Low';
    }
}