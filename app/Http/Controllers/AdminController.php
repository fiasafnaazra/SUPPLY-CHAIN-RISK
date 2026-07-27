<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\WeatherCache;
use App\Models\NewsCache;
use App\Models\RiskScore;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUser = User::where('role', 'user')->count();

        $totalAdmin = User::where('role', 'admin')->count();

        $totalCountry = Country::count();

        $totalWeather = WeatherCache::count();

        $totalNews = NewsCache::count();

        $totalRisk = RiskScore::where('risk_level', 'High')->count();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalAdmin',
            'totalCountry',
            'totalWeather',
            'totalNews',
            'totalRisk'
        ));
    }
}