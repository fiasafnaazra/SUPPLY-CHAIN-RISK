<?php

namespace App\Http\Controllers;

use App\Models\NewsCache;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsCache::orderBy('published_at', 'desc')->get();

        return view('news.index', compact('news'));
    }
}