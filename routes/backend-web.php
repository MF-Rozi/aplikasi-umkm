<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin','middleware' => ['role:super-admin|admin']], function () {

    Route::get('/', [HomeController::class, 'index']);
});
