<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCache extends Model
{
    protected $table = 'news_caches';

    protected $fillable = [

        'country_code',

        'title',

        'description',

        'source',

        'url',

        'image',

        'published_at',

        'category',

        'sentiment',

        'sentiment_score',

    ];

    protected $casts = [

        'published_at' => 'datetime',

    ];
}