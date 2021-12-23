<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\TransactionController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/home', function () {
    return redirect(route('frontend.home.index'));
});
Route::get('/', [HomeController::class, 'index'])->name('frontend.home.index');
Route::get('/about', [HomeController::class, 'about'])->name('frontend.home.about');
Route::get('/404', [HomeController::class, 'notFound'])->name('frontend.home.404');
Route::get('/contact', [HomeController::class, 'contact'])->name('frontend.home.contact');

Route::group(['prefix' => 'shop'], function () {
    Route::get('/', [ShopController::class, 'index'])->name('frontend.shop.index');
    Route::get('/{slug}/detail', [ShopController::class, 'detail'])->name('frontend.shop.single-product');
});

Route::group(['prefix' => 'cart','middleware' => 'auth'], function () {
    Route::get('/', [CartController::class, 'index'])->name('frontend.cart.index');
    Route::post('/add', [CartController::class, 'addToCart'])->name('frontend.cart.add');
    Route::post('/update', [CartController::class, 'updateCart'])->name('frontend.cart.update');
    Route::post('/delete', [CartController::class, 'deleteCart'])->name('frontend.cart.delete');
});

Route::group(['prefix' => 'payment','middleware' => 'auth'], function () {
    Route::post('/notification', [PaymentController::class, 'notification'])->name('frontend.payment.notification')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class, Authenticate::class]);
    Route::get('/finish', [PaymentController::class, 'finish'])->name('frontend.payment.finish');
    Route::get('/unfinish', [PaymentController::class, 'unfinish'])->name('frontend.payment.unfinish');
    Route::get('/error', [PaymentController::class, 'unfinish'])->name('frontend.payment.error');
    Route::post('/', [PaymentController::class, 'create'])->name('frontend.payment.create');
});

Route::group(['prefix' => 'transaction','middleware' => 'auth'], function () {
    Route::get('/', [TransactionController::class, 'index'])->name('frontend.transaction.index');
    Route::get('/show/{id}', [TransactionController::class, 'show'])->name('frontend.transaction.show');
    Route::post('/cancel', [TransactionController::class, 'cancel'])->name('frontend.transaction.cancel');
});
