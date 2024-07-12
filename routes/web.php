<?php

use App\Http\Controllers\AmountController;
use App\Http\Controllers\ExchangeRateController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/exchange-rates', [ExchangeRateController::class, 'index'])->name('exchange-rates.index');
    Route::post('/exchange-rates', [ExchangeRateController::class, 'store'])->name('exchange-rates.store');
    Route::put('/exchange-rates/{currency}', [ExchangeRateController::class, 'update'])->name('exchange-rates.update');
    Route::delete('/exchange-rates/{currency}', [ExchangeRateController::class, 'destroy'])->name('exchange-rates.destroy');

    Route::get('/amounts', [AmountController::class, 'index'])->name('amounts.index');
    Route::post('/amounts', [AmountController::class, 'store'])->name('amounts.store');
    Route::put('/amounts/{amount}', [AmountController::class, 'update'])->name('amounts.update');
    Route::delete('/amounts/{amount}', [AmountController::class, 'destroy'])->name('amounts.destroy');
});
