<?php

use App\Http\Controllers\FixturesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\StandingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/generate-simulation', [HomeController::class, 'generateSimulation'])->name('generateSimulation');
Route::get('/{simulation}/fixtures', [FixturesController::class, 'index'])->name('fixtures');
Route::put('/{simulation}/fixtures/{fixture}', [FixturesController::class, 'update'])->name('fixtures.update');
Route::get('/{simulation}/standings', [StandingController::class, 'index'])->name('standings');
Route::post('/{simulation}/play-week', [SimulationController::class, 'playWeek'])->name('simulation.playWeek');
Route::post('/{simulation}/play-all', [SimulationController::class, 'playAll'])->name('simulation.playAll');
Route::delete('/{simulation}/reset', [SimulationController::class, 'reset'])->name('simulation.reset');
