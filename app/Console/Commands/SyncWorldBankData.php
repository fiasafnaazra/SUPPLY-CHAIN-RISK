<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\CountryEconomic;
use App\Services\WorldBankService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('worldbank:sync')]
#[Description('Sinkronisasi data ekonomi dari World Bank API')]
class SyncWorldBankData extends Command
{
    public function handle(WorldBankService $worldBank)
    {
        $countries = Country::all();

        foreach ($countries as $country) {

            try {

                $this->info("Mengambil data {$country->country_name}...");

                // GDP
                $gdp = $worldBank->getIndicator(
                    $country->country_code,
                    'NY.GDP.MKTP.CD'
                );

                // Inflasi
                $inflation = $worldBank->getIndicator(
                    $country->country_code,
                    'FP.CPI.TOTL.ZG'
                );

                // Populasi
                $population = $worldBank->getIndicator(
                    $country->country_code,
                    'SP.POP.TOTL'
                );

                // Ekspor
                $export = $worldBank->getIndicator(
                    $country->country_code,
                    'NE.EXP.GNFS.CD'
                );

                // Impor
                $import = $worldBank->getIndicator(
                    $country->country_code,
                    'NE.IMP.GNFS.CD'
                );

                CountryEconomic::updateOrCreate(

                    [
                        'country_code' => $country->country_code
                    ],

                    [
                        // Ambil tahun dari World Bank API
                        'year' => $gdp['year'] ?? null,

                        'gdp' => $gdp['value'] ?? null,

                        'inflation' => $inflation['value'] ?? null,

                        'population' => $population['value'] ?? null,

                        'export' => $export['value'] ?? null,

                        'import' => $import['value'] ?? null,
                    ]
                );

                $this->info("✔ Berhasil {$country->country_name}");

            } catch (\Exception $e) {

                $this->error("❌ Gagal {$country->country_name}");
                $this->error($e->getMessage());

            }
        }

        $this->info("==============================");
        $this->info("Sinkronisasi berhasil selesai.");
        $this->info("==============================");
    }
}