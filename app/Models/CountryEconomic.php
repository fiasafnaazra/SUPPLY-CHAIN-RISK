<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryEconomic extends Model
{
    protected $fillable = [
        'country_code',
        'year',
        'gdp',
        'inflation',
        'population',
        'export',
        'import'
    ];

    public function country()
    {
    return $this->belongsTo(Country::class, 'country_code', 'country_code');
    }
}