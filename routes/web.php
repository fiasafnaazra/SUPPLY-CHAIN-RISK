<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CountryEconomicController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\SupplyChainController;
use App\Http\Controllers\WatchlistController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCountryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPortController;
use App\Http\Controllers\AdminArticleController;

Route::get('/', function () {
    return redirect('/login');
});


// =========================
// Login
// =========================
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);


// =========================
// Register
// =========================
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerPost']);


// =========================
// Dashboard User
// =========================
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('login')
    ->name('dashboard');


// =========================
// Logout
// =========================
Route::get('/logout', [AuthController::class, 'logout']);


// =========================
// Countries (User)
// =========================
Route::get('/countries', [CountryController::class, 'index'])
    ->name('countries.index');

Route::get('/countries/import', [CountryController::class, 'import'])
    ->name('countries.import');

Route::get('/countries/search', [CountryController::class, 'search'])
    ->name('countries.search');


// Sinkronisasi Data Ekonomi
Route::get('/sync-economics', [CountryEconomicController::class, 'sync']);


// =========================
// Weather
// =========================
Route::get('/weather', [WeatherController::class, 'index'])
    ->name('weather.index');


// =========================
// News
// =========================
Route::get('/news', [NewsController::class, 'index'])
    ->middleware('login')
    ->name('news.index');


// =========================
// Ports (User)
// =========================
Route::get('/ports', [PortController::class, 'index'])
    ->name('ports.index');


// =========================
// Supply Chain
// =========================
Route::get('/supply-chain', [SupplyChainController::class, 'index'])
    ->name('supply-chain.index');

Route::get('/supply-chain/{country_code}', [SupplyChainController::class, 'show'])
    ->name('supply-chain.show');


// =========================
// Country Comparison
// =========================

// Halaman pilih 2 negara
Route::get('/comparison', [SupplyChainController::class, 'comparison'])
    ->name('comparison.index');

// Hasil perbandingan
Route::get('/comparison/result', [SupplyChainController::class, 'compare'])
    ->name('comparison.compare');


// =========================
// WATCHLIST
// =========================

Route::middleware('login')->group(function () {

    // Halaman Watchlist
    Route::get('/watchlist', [WatchlistController::class, 'index'])
        ->name('watchlist.index');

    // Tambah Watchlist
    Route::post('/watchlist/add/{country_code}', [WatchlistController::class, 'store'])
        ->name('watchlist.store');

    // Hapus Watchlist
    Route::delete('/watchlist/{id}', [WatchlistController::class, 'destroy'])
        ->name('watchlist.destroy');

});


// =======================================================
// ADMIN DASHBOARD
// =======================================================

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('login')
    ->name('admin.dashboard');


// =======================================================
// ADMIN CRUD
// =======================================================

Route::prefix('admin')
    ->middleware('login')
    ->name('admin.')
    ->group(function () {

        // =========================
        // Kelola Negara
        // =========================
        Route::resource('countries', AdminCountryController::class);

        // =========================
        // Kelola User
        // =========================
        Route::resource('users', AdminUserController::class);

        // =========================
        // Kelola Pelabuhan
        // =========================
        Route::resource('ports', AdminPortController::class);

        // =========================
        // Kelola Artikel Analisis
        // =========================
        Route::resource('articles', AdminArticleController::class);

    });