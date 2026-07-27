<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RestCountriesService
{
    protected string $baseUrl = 'https://countries.dev';

    protected array $negaraDipilih = [
        'MY', 'SG', 'TH', 'VN',
        'PH', 'BN', 'KH', 'LA', 'MM',
        'KR', 'IN', 'PK',
        'CA', 'MX', 'BR', 'AR',
        'GB', 'FR', 'IT', 'ES',
        'PT', 'NL', 'BE', 'CH', 'AT',
        'SE', 'NO', 'FI', 'DK', 'PL',
        'RU', 'UA', 'TR', 'SA', 'AE',
        'EG', 'ZA', 'NG', 'KE', 'AU',
        'NZ', 'CL', 'CO', 'PE', 'GR',
        'HU', 'OM', 'QA', 'WS', 'YE', 'ZM'
    ];

    public function ambilSemuaNegara(): array
    {
        $response = Http::timeout(30)->get("{$this->baseUrl}/countries");

        if (!$response->successful()) {
            Log::error('Gagal mengambil data negara');
            return [];
        }

        $data = $response->json();

        if (!is_array($data)) {
            return [];
        }

        $hasil = [];

        foreach ($data as $item) {

            if (!is_array($item)) {
                continue;
            }

            if (!in_array($item['alpha2Code'] ?? '', $this->negaraDipilih)) {
                continue;
            }

            $hasil[] = $this->formatData($item);
        }

        return $hasil;
    }

    public function ambilSatuNegara(string $kode)
    {
        $response = Http::timeout(30)->get("{$this->baseUrl}/alpha/{$kode}");

        if (!$response->successful()) {
            return null;
        }

        return $this->formatData($response->json());
    }

    private function formatData(array $item): array
    {
        $currency = '-';

        if (!empty($item['currencies']) && is_array($item['currencies'])) {

            foreach ($item['currencies'] as $kode => $value) {

                if (is_array($value)) {
                    $currency = $value['code'] ?? $kode;
                } else {
                    $currency = $kode;
                }

                break;
            }
        }

        return [

            'country_name' => $item['name'] ?? '-',

            'country_code' => $item['alpha2Code'] ?? '-',

            'capital' => $item['capital'] ?? '-',

            'continent' => $item['region'] ?? '-',

            'population' => $item['population'] ?? 0,

            'latitude' => $item['latlng'][0] ?? 0,

            'longitude' => $item['latlng'][1] ?? 0,

            'currency' => $currency,

            'flag' => $item['flags']['png'] ?? '',

        ];
    }
}