<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\SearchController;
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
Route::get('/home', [AuthController::class, 'index'])->name('home');
Route::get('/filter', [SearchController::class, 'filter'])->name('shops.filter');

Route::get('/detail/{shop}', [ShopController::class, 'show'])->name('shops.show');

Route::middleware('auth')->group(function () {

    Route::get('/email/verify', function (Request $request) {
        return view('auth.verify-email');
    })->middleware(['auth'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended(RouteServiceProvider::HOME);
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/', [MyPageController::class, 'userMyPage'])->middleware(['verified'])->name('userMyPage');

    Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->middleware(['verified'])->name('payment.show');

    Route::post('/payment', [PaymentController::class, 'payment'])->middleware(['verified'])->name('payment.process');

    Route::post('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->middleware(['verified'])->name('favorites.toggle.add');

    Route::delete('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->middleware(['verified'])->name('favorites.toggle.remove');

    Route::post('/reservations', [ReservationController::class, 'store'])->middleware(['verified'])->name('reservations.store');

    Route::get('/myPage', [MyPageController::class, 'showMyPage'])->middleware(['verified'])->name('myPage');

    Route::delete('/reservations/{reservation}', [MyPageController::class, 'destroyReservation'])->middleware(['verified'])->name('reservations.destroy');

    Route::get('/payment/thanks', [ReservationController::class, 'showThanksPage'])->name('payment.thanks');

    Route::get('/redirect-to-payment', [PaymentController::class, 'redirectToPayment'])->name('redirect.to.payment');
});
