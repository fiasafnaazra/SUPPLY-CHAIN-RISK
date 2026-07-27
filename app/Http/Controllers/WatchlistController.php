<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use App\Models\Country;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    // ==========================
    // Tampilkan Watchlist User
    // ==========================
    public function index()
    {
        $watchlists = Watchlist::where('user_id', session('user_id'))
            ->with('country')
            ->get();

        return view('watchlist.index', compact('watchlists'));
    }

    // ==========================
    // Tambah Watchlist
    // ==========================
    public function store($country_code)
    {
        Watchlist::firstOrCreate([
            'user_id'      => session('user_id'),
            'country_code' => $country_code,
        ]);

        return back()->with('success', 'Negara berhasil ditambahkan ke Watchlist.');
    }

    // ==========================
    // Hapus Watchlist
    // ==========================
    public function destroy($id)
    {
        $watchlist = Watchlist::findOrFail($id);

        if ($watchlist->user_id == session('user_id')) {
            $watchlist->delete();
        }

        return back()->with('success', 'Watchlist berhasil dihapus.');
    }
}