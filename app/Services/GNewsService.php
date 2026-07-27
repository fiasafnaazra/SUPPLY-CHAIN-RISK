<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GNewsService
{
    protected string $baseUrl = 'https://gnews.io/api/v4';

    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GNEWS_API_KEY');
    }

    /**
     * Mengambil berita berdasarkan keyword
     */
    public function getNews($keyword = 'logistics')
    {
        $response = Http::get($this->baseUrl . '/search', [
            'q'        => $keyword,
            'lang'     => 'en',
            'country'  => 'us',
            'max'      => 10,
            'apikey'   => $this->apiKey,
        ]);

        if (!$response->successful()) {
            return [];
        }

        return $response->json()['articles'] ?? [];
    }
}