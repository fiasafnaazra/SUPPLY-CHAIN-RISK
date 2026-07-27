<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class SupplyChainController extends Controller
{
    public function index()
    {
        $countries = Country::with([
            'weather',
            'economic',
            'currencyRate',
            'riskScore',
        ])
        ->orderBy('country_name')
        ->get();

        return view('supply-chain.index', compact('countries'));
    }

    public function show($country_code)
    {
        $country = Country::with([
            'weather',
            'economic',
            'currencyRate',
            'riskScore',
        ])
        ->where('country_code', $country_code)
        ->firstOrFail();

        return view('supply-chain.show', compact('country'));
    }

    // Halaman Perbandingan Negara
    public function comparison()
    {
        $countries = Country::orderBy('country_name')->get();

        return view('supply-chain.comparison', compact('countries'));
    }

    // Proses Perbandingan
    public function compare(Request $request)
    {
        $countries = Country::orderBy('country_name')->get();

        $country1 = Country::with([
            'economic',
            'weather',
            'currencyRate',
            'riskScore',
        ])
        ->where('country_code', $request->country1)
        ->first();

        $country2 = Country::with([
            'economic',
            'weather',
            'currencyRate',
            'riskScore',
        ])
        ->where('country_code', $request->country2)
        ->first();

        return view('supply-chain.comparison', compact(
            'countries',
            'country1',
            'country2'
        ));
    }
}