<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HouseController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('house', HouseController::class)->parameters(['house' => 'house:slug']);

        Route::resource('leads', LeadController::class)->except(['create', 'store']);

        Route::get('statistics', [StatisticController::class, 'index'])->name('statistics.index');

        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');

        Route::get('sponsorships', [SponsorshipController::class, 'index'])->name('sponsorships.index');

        // Aggiungi le rotte dei pagamenti qui
        Route::get('sponsorships/payment', [PaymentController::class, 'index'])->name('sponsorships.payment.form');
        Route::get('sponsorships/payment/token', [PaymentController::class, 'getToken'])->name('sponsorships.payment.token');
        Route::post('sponsorships/payment', [PaymentController::class, 'handlePayment'])->name('sponsorships.payment.handle');
        Route::get('sponsorships/payment/success', function () {
            return 'Pagamento avvenuto con successo!';
        })->name('sponsorships.payment.success');
        Route::get('sponsorships/payment/failed', function () {
            return 'Si è verificato un errore! Il pagamento non è stato effettuato.';
        })->name('sponsorships.payment.failed');
    });

// route for the show method of the ProfileController, protected by the 'auth' middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

// search
Route::get('/search', [HouseController::class, 'search'])->name('search');


require __DIR__ . '/auth.php';
