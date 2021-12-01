<?php

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileController;

Route::group(['prefix' => 'admin','middleware' => ['role:super-admin|admin']], function () {
    //user
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/users/{slug}/show', [UserController::class, 'show'])->name('admin.user.show');
    Route::get('/users/{slug}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::get('/users/{slug}/delete', [UserController::class, 'delete'])->name('admin.user.delete');
    Route::get('/users/index-datatable', [UserController::class, 'userListDataTable'])->name('admin.user.index.datatable');
    Route::put('/users/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::put('/users/passwordUpdate', [UserController::class, 'updatePassword'])->name('admin.user.update.password');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::put('/users/store', [UserController::class, 'store'])->name('admin.user.store');

    //profile
    Route::get('/profile/create/{id}', [ProfileController::class, 'create'])->name('admin.profile.create');
    Route::put('/profile/store', [ProfileController::class, 'store'])->name('admin.profile.store');

    //category
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/categories/index-datatable', [CategoryController::class, 'categoryListDataTable'])->name('admin.category.index.datatable');
    Route::get('/categories/show/{slug}', [CategoryController::class, 'show'])->name('admin.category.show');
    Route::get('/categories/edit/{slug}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::get('/categories/delete/{slug}', [CategoryController::class, 'delete'])->name('admin.category.delete');
});
