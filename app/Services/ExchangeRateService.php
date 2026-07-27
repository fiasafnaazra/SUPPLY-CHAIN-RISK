<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    protected $baseUrl = "https://open.er-api.com/v6/latest/USD";

    public function getRates()
    {
        $response = Http::get($this->baseUrl);

        if(!$response->successful()){
            return null;
        }

        return $response->json('rates');
    }
}