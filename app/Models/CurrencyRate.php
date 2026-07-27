<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    protected $table = 'currency_rates';

    protected $fillable = [
        'country_code',
        'currency_code',
        'exchange_rate',
        'fetched_at',
    ];

    protected $casts = [
        'exchange_rate' => 'float',
        'fetched_at'    => 'datetime',
    ];
}