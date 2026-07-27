<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\NewsCache;
use App\Services\RestCountriesService;
use Illuminate\Http\Request;


class CountryController extends Controller
{
    protected $restCountriesService;

    public function __construct(RestCountriesService $restCountriesService)
    {
        $this->restCountriesService = $restCountriesService;
    }

    /**
     * Menampilkan daftar negara
     */
    public function index()
    {
        // Jika database kosong, import dari API
        if (Country::count() == 0) {

            $countries = $this->restCountriesService->ambilSemuaNegara();

            foreach ($countries as $country) {

                Country::updateOrCreate(
                    [
                        'country_code' => $country['country_code'],
                    ],
                    $country
                );
            }
        }

        // Ambil semua negara beserta data ekonomi, cuaca, dan kurs
        $countries = Country::with([
            'economic',
            'weather',
            'currencyRate',
            'riskScore',
        ])
        ->orderBy('country_name')
        ->get();

        $news = NewsCache::latest()->take(5)->get();

        return view('countries.index', compact('countries', 'news'));
    }

    /**
     * Import ulang data negara
     */
    public function import()
    {
        $countries = $this->restCountriesService->ambilSemuaNegara();

        foreach ($countries as $country) {

            Country::updateOrCreate(
                [
                    'country_code' => $country['country_code'],
                ],
                $country
            );
        }

        return redirect()
            ->route('countries.index')
            ->with('success', 'Data negara berhasil diimport.');
    }

    /**
     * Pencarian negara
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $countries = Country::with([
            'economic',
            'weather',
            'currencyRate',
            'riskScore',
        ])
        ->where('country_name', 'like', "%{$keyword}%")
        ->orderBy('country_name')
        ->get();

        $countryName = $countries->first()?->country_name;

        if ($countryName) {

        $news = NewsCache::where('title', 'like', "%{$countryName}%")
        ->orWhere('description', 'like', "%{$countryName}%")
        ->latest()
        ->take(5)
        ->get();

        } else {

        $news = collect();

        }
       return view('countries.index', compact('countries', 'news'));
    }
}