<?php

use App\Http\Controllers\AdminController;
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

Route::resource('listing', ListingController::class)->except((['create', 'buy', 'change_active']));


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [SneakerController::class, 'index'])->name('dashboard');

    Route::resource('sneaker', SneakerController::class);

    Route::get('listing/create/{id}', [ListingController::class, 'create'])->name('listing.create');
    Route::put('listing/details/{id}', [ListingController::class, 'buy'])->name('listing.buy');
    Route::put('/dashboard/{id}', [ListingController::class, 'change_active'])->name('listing.change_active');
  });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard')->middleware('admin');
    Route::put('/admin/approve/{listing}', [AdminController::class, 'approve_listing'])->name('admin.approve_listing')->middleware('admin');
    Route::put('/admin/decline/{listing}', [AdminController::class, 'decline_listing'])->name('admin.decline_listing')->middleware('admin');
});



Auth::routes();
