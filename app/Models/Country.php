<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CountryEconomic;
use App\Models\WeatherCache;
use App\Models\CurrencyRate;
use App\Models\RiskScore;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'country_name',
        'country_code',
        'capital',
        'continent',
        'population',
        'latitude',
        'longitude',
        'currency',
        'flag',
    ];

    // Relasi Data Ekonomi
    public function economic()
    {
        return $this->hasOne(
            CountryEconomic::class,
            'country_code',
            'country_code'
        );
    }

    // Relasi Data Cuaca
    public function weather()
    {
        return $this->hasOne(
            WeatherCache::class,
            'country_code',
            'country_code'
        );
    }

    // Relasi Data Kurs Mata Uang
    public function currencyRate()
    {
        return $this->hasOne(
            CurrencyRate::class,
            'country_code',
            'country_code'
        );
    }

    // Relasi Skor Risiko
    public function riskScore()
    {
        return $this->hasOne(
            RiskScore::class,
            'country_code',
            'country_code'
        );
    }

    public function watchlists()
    {
    return $this->hasMany(Watchlist::class, 'country_code', 'country_code');
    }
}