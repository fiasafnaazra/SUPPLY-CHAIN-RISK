<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [

        'title',
        'country_code',
        'risk_level',
        'summary',
        'content',
        'image',
        'published_at',

    ];
}