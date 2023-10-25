<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SneakerController;
use App\Models\Sneaker;
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
Route::get('/' , [ListingController::class, 'index'], function () {
    return view('home');
});

Route::get('/dashboard', [SneakerController::class, 'index'])->name('dashboard');

Route::resource('sneaker', SneakerController::class);
Route::resource('listing', ListingController::class)->except((['create', 'buy', 'change_active']));

Route::get('listing/create/{id}', [ListingController::class, 'create'])->name('listing.create');
Route::put('listing/details/{id}', [ListingController::class, 'buy'])->name('listing.buy');
Route::put('/dashboard/{id}', [ListingController::class, 'change_active'])->name('listing.change_active');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
