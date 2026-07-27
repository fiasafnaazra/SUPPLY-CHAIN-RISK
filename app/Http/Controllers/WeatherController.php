<?php

namespace App\Http\Controllers;

use App\Models\WeatherCache;

class WeatherController extends Controller
{
    public function index()
    {
        $weather = WeatherCache::join(
                'countries',
                'weather_cache.country_code',
                '=',
                'countries.country_code'
            )
            ->select(
                'weather_cache.*',
                'countries.country_name',
                'countries.latitude',
                'countries.longitude'
            )
            ->orderBy('country_code')
            ->get();

        return view('weather.index', compact('weather'));
    }
}