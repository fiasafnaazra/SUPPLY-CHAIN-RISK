<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WorldBankService
{
    protected $baseUrl = 'https://api.worldbank.org/v2';

    public function getIndicator($countryCode, $indicator)
    {
        $response = Http::timeout(60)
            ->retry(3, 2000)
            ->get(
                "{$this->baseUrl}/country/{$countryCode}/indicator/{$indicator}",
                [
                    'format' => 'json',
                    'per_page' => 1,
                ]
            );

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();

        if (!isset($data[1][0])) {
            return null;
        }

        return [
            'value' => $data[1][0]['value'] ?? null,
            'year'  => $data[1][0]['date'] ?? null,
        ];
    }
}