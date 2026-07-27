<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\WeatherCache;
use App\Models\NewsCache;
use App\Models\RiskScore;
use App\Models\CountryEconomic;
use App\Models\CurrencyRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Halaman Login
    public function login()
    {
        return view('auth.login');
    }

    // Halaman Register
    public function register()
    {
        return view('auth.register');
    }

    // Proses Register
    public function registerPost(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:user,admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect('/login')->with('success', 'Register berhasil.');
    }

    // Proses Login
    public function loginPost(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau Password salah.');
        }

        session([
            'login'   => true,
            'user_id' => $user->id,
            'name'    => $user->name,
            'role'    => $user->role,
        ]);

        // Redirect berdasarkan role
        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/dashboard');
    }

    // Dashboard User
    public function dashboard()
    {
        // Jumlah Negara
        $totalCountry = Country::count();

        // Jumlah Data Cuaca
        $totalWeather = WeatherCache::count();

        // Jumlah Berita
        $totalNews = NewsCache::count();

        // Jumlah Negara Berisiko Tinggi
        $totalRisk = RiskScore::where('risk_level', 'High')->count();

        // Data GDP
        $gdp = CountryEconomic::orderByDesc('gdp')
            ->take(10)
            ->get();

        // Data Inflasi
        $inflation = CountryEconomic::orderByDesc('inflation')
            ->take(10)
            ->get();

        // Data Kurs Mata Uang
        $currency = CurrencyRate::orderByDesc('exchange_rate')
            ->take(10)
            ->get();

        // Data Risk Score
        $risk = RiskScore::orderByDesc('total_score')
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalCountry',
            'totalWeather',
            'totalNews',
            'totalRisk',
            'gdp',
            'inflation',
            'currency',
            'risk'
        ));
    }

    // Logout
    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}