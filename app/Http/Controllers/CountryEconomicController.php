<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CountryEconomic;
use App\Services\WorldBankService;

class CountryEconomicController extends Controller
{
    protected $worldBank;

    public function __construct(WorldBankService $worldBank)
    {
        $this->worldBank = $worldBank;
    }

    public function sync()
    {
        $countries = Country::take(5)->get();

        foreach ($countries as $country) {

            CountryEconomic::updateOrCreate(

                [
                    'country_code' => $country->country_code
                ],

                [
                    'year' => now()->year,

                    'gdp' => $this->worldBank->getIndicator(
                        $country->country_code,
                        'NY.GDP.MKTP.CD'
                    ),

                    'inflation' => $this->worldBank->getIndicator(
                        $country->country_code,
                        'FP.CPI.TOTL.ZG'
                    ),

                    'population' => $this->worldBank->getIndicator(
                        $country->country_code,
                        'SP.POP.TOTL'
                    ),

                    'export' => $this->worldBank->getIndicator(
                        $country->country_code,
                        'NE.EXP.GNFS.CD'
                    ),

                    'import' => $this->worldBank->getIndicator(
                        $country->country_code,
                        'NE.IMP.GNFS.CD'
                    ),

                ]
            );
        }

        return "Data ekonomi berhasil disimpan.";
    }
}