<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\StatisticsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Guests\PageController as GuestsPageController;

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

Route::get('/', [GuestsPageController::class, 'home'])->name('guests.home');

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminPageController::class, 'dashboard'])->name('dashboard');
        Route::get('/apartments/{id}/chat', [ApartmentController::class, 'chat'])->name('apartments.chat');
        Route::resource('apartments', ApartmentController::class);
        // Sponsorships Controller
        Route::get('/apartments/{id}/sponsorship', [SponsorshipController::class, 'index'])
            ->name('apartments.sponsorship.index');
        Route::post('apartments/{id}/sponsorship/payment', [SponsorshipController::class, 'payment'])
            ->name('apartments.sponsorship.payment');
        // Payment Controller
        Route::post('/apartments/{apartment}/sponsorship/payment/process-payment', [PaymentController::class, 'processPayment'])
            ->name('processPayment');
        // Statistics Controller
        Route::get('apartments/{id}/statistics', [StatisticsController::class, 'index'])
            ->name('apartments.statistics');
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
