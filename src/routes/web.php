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
Route::get('/', [AuthController::class, 'index']);
Route::get('/filter', [SearchController::class, 'filter'])->name('shops.filter');

Route::get('/detail/{shop}', [ShopController::class, 'show'])->name('shops.show');

Route::middleware('auth')->group(function () {

    Route::get('/email/verify', function (Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('mypage');
        }
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended(RouteServiceProvider::HOME);
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/', [MyPageController::class, 'userMyPage']);

    Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.show');

    Route::post('/payment', [PaymentController::class, 'payment'])->name('payment.process');

    Route::post('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle.add');

    Route::delete('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle.remove');

    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    Route::get('/mypage', [MyPageController::class, 'showMyPage'])->name('mypage');

    Route::delete('/reservations/{reservation}', [MyPageController::class, 'destroyReservation'])->name('reservations.destroy');

});
