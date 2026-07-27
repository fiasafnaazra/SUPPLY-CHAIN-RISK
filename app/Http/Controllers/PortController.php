<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Port;

class PortController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $ports = Port::query()

            ->when($keyword, function ($query) use ($keyword) {

                $query->where('port_name', 'like', "%{$keyword}%")
                      ->orWhere('country_code', 'like', "%{$keyword}%")
                      ->orWhere('region', 'like', "%{$keyword}%");

            })

            ->orderBy('port_name')

            ->paginate(100);

        return view('ports.index', compact('ports'));
    }
}