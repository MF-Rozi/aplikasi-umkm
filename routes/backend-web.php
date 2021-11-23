<?php

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin','middleware' => ['role:super-admin|admin']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/users/view/{id}', [UserController::class, 'show'])->name('admin.user.show');
    Route::get('/users/index-datatable', [UserController::class, 'userListDataTable'])->name('admin.user.index.datatable');
});
