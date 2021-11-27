<?php

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;

Route::group(['prefix' => 'admin','middleware' => ['role:super-admin|admin']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/users/show/{slug}', [UserController::class, 'show'])->name('admin.user.show');
    Route::post('/users/edit/{slug}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::get('/users/delete/{slug}', [UserController::class, 'delete'])->name('admin.user.delete');
    Route::get('/users/index-datatable', [UserController::class, 'userListDataTable'])->name('admin.user.index.datatable');
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/categories/index-datatable', [CategoryController::class, 'categoryListDataTable'])->name('admin.category.index.datatable');
    Route::get('/categories/show/{slug}', [CategoryController::class, 'show'])->name('admin.category.show');
    Route::get('/categories/edit/{slug}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::get('/categories/delete/{slug}', [CategoryController::class, 'delete'])->name('admin.category.delete');
});
