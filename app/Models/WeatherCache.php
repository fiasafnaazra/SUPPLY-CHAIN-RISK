<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherCache extends Model
{
    protected $table = 'weather_cache';

    protected $fillable = [

        'country_code',

        'temperature',

        'precipitation',

        'wind_speed',

        'storm_risk',

        'fetched_at',
    ];

    protected $casts = [

        'fetched_at' => 'datetime',
    ];
}