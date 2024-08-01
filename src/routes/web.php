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
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\ShopRepresentativeLoginController;
use App\Http\Controllers\Auth\ShopRepresentativeController;
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

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');

Route::get('/shop-representative/login', [ShopRepresentativeLoginController::class, 'showLoginForm'])->name('shop-representative.login');
Route::post('/shop-representative/login', [ShopRepresentativeLoginController::class, 'login']);
Route::get('/shop-representative/dashboard', [ShopRepresentativeController::class, 'dashboard'])->name('shop-representative.dashboard')->middleware('auth:shop_representative');

Route::get('/shop-edit', [ShopRepresentativeController::class, 'create'])->name('shop.edit.create');
Route::post('/shop-representative/store', [ShopRepresentativeController::class, 'store'])->name('shop-representative.store');



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

    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->middleware(['verified'])->name('reservations.edit');

    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->middleware(['verified'])->name('reservations.update');

    Route::post('/shops/{shop}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
