<?php

use Illuminate\Support\Facades\Route;
use App\Services\OpenWeatherMapService;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContratController;
use App\Http\Controllers\Admin\VoitureController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\VehiculeController;
use App\Http\Controllers\Admin\ChauffeurController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/coordonne', [\App\Http\Controllers\CityController::class, 'testWeather']);

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get("/profile", [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/location/client', [LocationController::class, 'clocation'])
    ->name('location.client')
    ->middleware('auth')
;

Route::prefix('admin') -> name("admin.")
    -> middleware('auth')
    -> group( function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            -> name('dashboard')  ;
        Route::resource('role', RoleUserController::class)->except('show');
        Route::resource('voiture', VoitureController::class);
        Route::resource('user', UserController::class);
        Route::resource('chauffeur', ChauffeurController::class);
        Route::resource('contrat', ContratController::class);
        Route::resource('location', LocationController::class);
        Route::resource('client', ClientController::class);
        Route::resource('payement', \App\Http\Controllers\Admin\PayementController::class)
            ->except('show', 'edit', 'create');

        Route::post('/assinge/{chauffeur}',[ChauffeurController::class, 'addVehicule'])
            ->name('chauffeur.addVehicule');
    });

Route::post('/noter', [ChauffeurController::class, 'noter'])
    ->name('note.store')
    ->middleware('auth');

require __DIR__.'/auth.php';
