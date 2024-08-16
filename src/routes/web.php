<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\ShopRepresentativeLoginController;
use App\Http\Controllers\ShopRepresentative\ShopRepresentativeController;
use App\Http\Controllers\ShopRepresentative\ShopEditController;
use App\Http\Controllers\ShopRepresentative\ReservationListController;
use App\Http\Controllers\ShopRepresentative\QRScannerController;
use App\Http\Controllers\Admin\AdminEmailController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ShopOwnerCreateController;

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
Route::get('/filter', [SearchController::class, 'filter'])->name('shops_filter');
// Route::get('/detail/{shop}', [ShopController::class, 'show'])->name('shops.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/edit', [ShopOwnerCreateController::class, 'create'])->name('edit_create');
        Route::post('/store', [ShopOwnerCreateController::class, 'store'])->name('store');
        Route::get('/send_email', [AdminEmailController::class, 'showForm'])->name('send_email_form');
        Route::post('/send_email', [AdminEmailController::class, 'sendEmail'])->name('send_email');
    });
});

Route::prefix('shop_representative')->name('shop_representative.')->group(function () {
    Route::get('/login', [ShopRepresentativeLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ShopRepresentativeLoginController::class, 'login']);

    Route::middleware('auth:shop_representative')->group(function () {
        Route::get('/dashboard', [ShopRepresentativeController::class, 'dashboard'])->name('dashboard');
        Route::get('/{id}/edit', [ShopEditController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [ShopEditController::class, 'update'])->name('update');
        Route::get('/reservation/list', [ReservationListController::class, 'reservationList'])->name('reservations_list');
        Route::get('/shop_representative/create', [ShopRepresentativeController::class, 'create'])->name('shop_create');
        Route::post('/shop_representative/store', [ShopRepresentativeController::class, 'store'])->name('shop_store');
        Route::get('/reservation/verify/{id}', [ReservationController::class, 'verifyReservation'])->name('reservation.verify');
        Route::get('/qr-scanner', [QRScannerController::class, 'showScanner'])->name('qr_scanner');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/thanks', function (Request $request) {
        return view('auth.verify_email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended(RouteServiceProvider::HOME);
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::middleware('verified')->group(function () {

        Route::get('/', [MyPageController::class, 'userMyPage'])->name('user_my_page');

        Route::get('/detail/{shop}', [ShopController::class, 'show'])->name('shops.show');

        Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.show');
        Route::post('/payment/success', [PaymentController::class, 'payment'])->name('payment.process');
        Route::get('/redirect-to-payment', [PaymentController::class, 'redirectToPayment'])->name('redirect.to.payment');

        Route::post('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle.add');
        Route::delete('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle.remove');
        Route::get('/myPage/{shop}', [MyPageController::class, 'showMyPage'])->name('myPage');

        Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
        Route::get('/reservation_thanks', [MyPageController::class, 'reservationThanks'])->name('reservation.thanks');
        Route::get('/done/{reservationId}', [ReservationController::class, 'generateQRCode'])->name('payment.thanks');


        Route::delete('/reservations/{reservation}', [MyPageController::class, 'destroyReservation'])->name('reservations.destroy');

        Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');

        Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');

        Route::post('/shops/{shop}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

        Route::get('/shops/{shop}/reviews', [ReviewController::class, 'index'])->name('reviews.index');

        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    });
});
