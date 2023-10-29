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

// Routes for everyone
Route::get('/' , [ListingController::class, 'index'], function () {
    return view('home');
});
Route::resource('listing', ListingController::class)->except((['create', 'buy', 'change_active', 'search']));
Route::get('/', [ListingController::class, 'search'])->name('listing.search');

// Routes for Authenticated users
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [SneakerController::class, 'index'])->name('dashboard');
    Route::get('listing/create/{id}', [ListingController::class, 'create'])->name('listing.create');
    Route::get('listing/edit/{id}', [ListingController::class, 'edit'])->name('listing.edit');
    Route::put('listing/details/{id}', [ListingController::class, 'buy'])->name('listing.buy');
    Route::post('/dashboard/{id}', [ListingController::class, 'change_active'])->name('listing.change_active');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('sneaker', SneakerController::class);
  });

  // Routes for admin users
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard')->middleware('admin');
    Route::put('/admin/approve/{listing}', [AdminController::class, 'approve_listing'])->name('admin.approve_listing')->middleware('admin');
    Route::put('/admin/decline/{listing}', [AdminController::class, 'decline_listing'])->name('admin.decline_listing')->middleware('admin');
});

Auth::routes();
