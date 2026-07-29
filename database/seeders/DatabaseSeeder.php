<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
use App\Models\WeatherCache;
use App\Models\NewsCache;
use App\Models\CountryEconomic;
use App\Models\CurrencyRate;
use App\Models\RiskScore;
use App\Services\RestCountriesService;
use App\Services\RiskScoringService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Default Accounts
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // 2. Sentiment Words
        $this->call([
            PositiveWordSeeder::class,
            NegativeWordSeeder::class,
        ]);

        // 3. Countries
        if (Country::count() == 0) {
            try {
                $service = app(RestCountriesService::class);
                $countries = $service->ambilSemuaNegara();
                foreach ($countries as $c) {
                    Country::updateOrCreate(['country_code' => $c['country_code']], $c);
                }
            } catch (\Exception $e) {
                // Fallback sample countries if API fails
                $sampleCountries = [
                    ['country_name' => 'Indonesia', 'country_code' => 'ID', 'capital' => 'Jakarta', 'continent' => 'Asia', 'population' => 273753191, 'latitude' => -6.2, 'longitude' => 106.8, 'currency' => 'IDR'],
                    ['country_name' => 'Malaysia', 'country_code' => 'MY', 'capital' => 'Kuala Lumpur', 'continent' => 'Asia', 'population' => 32365999, 'latitude' => 3.1, 'longitude' => 101.7, 'currency' => 'MYR'],
                    ['country_name' => 'Singapore', 'country_code' => 'SG', 'capital' => 'Singapore', 'continent' => 'Asia', 'population' => 5685807, 'latitude' => 1.35, 'longitude' => 103.8, 'currency' => 'SGD'],
                    ['country_name' => 'United States', 'country_code' => 'US', 'capital' => 'Washington, D.C.', 'continent' => 'Americas', 'population' => 331002651, 'latitude' => 38.89, 'longitude' => -77.03, 'currency' => 'USD'],
                    ['country_name' => 'China', 'country_code' => 'CN', 'capital' => 'Beijing', 'continent' => 'Asia', 'population' => 1411778724, 'latitude' => 39.9, 'longitude' => 116.4, 'currency' => 'CNY'],
                ];
                foreach ($sampleCountries as $sc) {
                    Country::updateOrCreate(['country_code' => $sc['country_code']], $sc);
                }
            }
        }

        // 4. Weather Cache
        if (WeatherCache::count() == 0) {
            $risks = ['Low', 'Medium', 'High'];
            foreach (Country::all() as $index => $country) {
                WeatherCache::updateOrCreate(
                    ['country_code' => $country->country_code],
                    [
                        'temperature' => 24 + ($index % 10),
                        'precipitation' => ($index * 3) % 40,
                        'wind_speed' => 10 + ($index % 25),
                        'storm_risk' => $risks[$index % 3],
                        'fetched_at' => now(),
                    ]
                );
            }
        }

        // 5. News Cache
        if (NewsCache::count() == 0) {
            $sampleNews = [
                ['title' => 'Global Supply Chain Bottleneck Eases in Q3', 'description' => 'Major ports report smooth operations and reduced container wait times.', 'source' => 'Global Trade News', 'url' => 'https://example.com/news/1', 'sentiment' => 'Positive', 'sentiment_score' => 2.5],
                ['title' => 'Severe Storm Delays Shipping in South China Sea', 'description' => 'Heavy rainfall and high winds cause vessel holding patterns.', 'source' => 'Maritime Executive', 'url' => 'https://example.com/news/2', 'sentiment' => 'Negative', 'sentiment_score' => -3.0],
                ['title' => 'Fuel Price Surge Impacts Freight Logistics Rates', 'description' => 'Rising energy costs push transport tariffs higher across ASEAN.', 'source' => 'Logistics Weekly', 'url' => 'https://example.com/news/3', 'sentiment' => 'Negative', 'sentiment_score' => -2.0],
            ];

            foreach ($sampleNews as $news) {
                NewsCache::updateOrCreate(
                    ['url' => $news['url']],
                    array_merge($news, [
                        'country_code' => 'GLOBAL',
                        'published_at' => now(),
                        'category' => 'logistics',
                    ])
                );
            }
        }

        // 6. Economic & Currency Rates
        foreach (Country::all() as $index => $country) {
            CountryEconomic::updateOrCreate(
                ['country_code' => $country->country_code],
                [
                    'year' => 2024,
                    'gdp' => 50000000000 + ($index * 15000000000),
                    'inflation' => 2.5 + ($index % 8),
                    'population' => $country->population ?? 50000000,
                    'export' => 10000000000 + ($index * 5000000000),
                    'import' => 9000000000 + ($index * 4500000000),
                ]
            );

            CurrencyRate::updateOrCreate(
                ['country_code' => $country->country_code],
                [
                    'currency_code' => $country->currency ?? 'USD',
                    'exchange_rate' => 1.0 + ($index % 15),
                    'fetched_at' => now(),
                ]
            );
        }

        // 7. Calculate Risk Scores
        $riskService = app(RiskScoringService::class);
        foreach (Country::all() as $country) {
            $weather = $country->weather;
            $economic = $country->economic;
            $currency = $country->currencyRate;
            $news = NewsCache::where('country_code', $country->country_code)->get();
            if ($news->count() == 0) {
                $news = NewsCache::where('country_code', 'GLOBAL')->get();
            }

            $score = $riskService->calculate($weather, $economic, $currency, $news);

            RiskScore::updateOrCreate(
                ['country_code' => $country->country_code],
                [
                    'weather_score' => $score['weather_score'],
                    'inflation_score' => $score['inflation_score'],
                    'currency_score' => $score['currency_score'],
                    'news_score' => $score['news_score'],
                    'total_score' => $score['total_score'],
                    'risk_level' => $score['risk_level'],
                ]
            );
        }
    }
}
