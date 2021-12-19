<?php

use App\Http\Controllers\Frontend\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('frontend.home.index');
Route::get('/about', [HomeController::class, 'about'])->name('frontend.home.about');
Route::get('/404', [HomeController::class, 'notFound'])->name('frontend.home.404');
Route::get('/contact', [HomeController::class, 'contact'])->name('frontend.home.contact');
