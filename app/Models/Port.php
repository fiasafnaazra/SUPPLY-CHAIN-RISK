<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    protected $fillable = [

        'port_name',
        'alternate_name',
        'country_code',
        'region',
        'water_body',
        'latitude',
        'longitude',
        'harbor_type',
        'harbor_size',
        'harbor_use',

    ];
}