<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HouseController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\StatisticController;
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
    return view('welcome');
});

Route::middleware('auth')
    ->prefix('admin') // prefix of the url of the route
    ->name('admin.') // prefix of route name
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('house', HouseController::class)->parameters(['house' => 'house:slug']);

        Route::get('statistics', [StatisticController::class, 'index'])->name('statistics.index');

        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');

        Route::get('sponsorships', [SponsorshipController::class, 'index'])->name('sponsorships.index');
    });

        // route for the show method of the ProfileController, protected by the 'auth' middleware.
        Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');;
});


// search
Route::get('/search', [HouseController::class, 'search'])->name('search');


require __DIR__ . '/auth.php';
