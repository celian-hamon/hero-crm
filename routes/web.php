<?php

use App\Http\Controllers\City\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Hero\GetHeroInRangeController;
use App\Http\Controllers\Incident\IncidentController;
use App\Http\Controllers\ProfileController;
use App\Models\City;
use App\Models\Incident;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'incidents' => Incident::all(),
        'cities' => City::all(),
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'get'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/heroes', [GetHeroInRangeController::class,'GetHeroInRange'])->name('heroes.get');
Route::post('/accident', [IncidentController::class,'CreateAccident'])->name('accident.create');
Route::put('/accident', [IncidentController::class,'UpdateAccident'])->name('accident.edit');
Route::post('/city', [CityController::class,'CreateCity'])->name('city.create');

require __DIR__.'/auth.php';
