<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

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
  return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
  $settings = Settings::where('user_id', '=', Auth::user()->id)->first();
  return view('dashboard')->with(compact('settings'));
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

//Route::resource('days', DayController::class)->middleware(['auth']);
Route::get('/days', [DayController::class, 'index'])->name('days.index');
Route::get('/day/create', [DayController::class, 'create'])->name('day.create');
Route::post('/day', [DayController::class, 'store'])->name('day.store');
Route::get('/day/{date}', [DayController::class, 'show'])->name('day.show');
Route::get('/day/edit/{date}', [DayController::class, 'edit'])->name('day.edit');
Route::post('/day/{date}', [DayController::class, 'update'])->name('day.update');
Route::delete('/day/{date}', [DayController::class, 'destroy'])->name('day.destroy');

Route::resource('holidays', HolidayController::class);
Route::resource('months', MonthController::class)->middleware(['auth']);
//Route::resource('settings', SettingsController::class)->middleware(['auth']);
Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
