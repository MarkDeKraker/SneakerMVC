<?php

use App\Http\Controllers\ProfileController;
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
    return view('home');
});

Route::get('/dashboard', 'App\Http\Controllers\SneakerController@sneakers', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', 'App\Http\Controllers\SneakerController@index')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/sneaker/create', function () {
    return view('sneaker.create');
})->middleware(['auth', 'verified'])->name('sneaker.create');

Route::post('/sneaker/create', 'App\Http\Controllers\SneakerController@create')->name('sneaker.create');
Route::get('/sneaker/details/{id}', 'App\Http\Controllers\SneakerController@sneaker')->name('sneaker.sneaker');

require __DIR__.'/auth.php';
