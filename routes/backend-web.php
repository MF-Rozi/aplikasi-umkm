<?php

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductPictureController;
use App\Http\Controllers\Backend\ProfileController;
use App\Models\ProductPicture;

Route::group(['prefix' => 'admin', 'middleware' => ['role:super-admin|admin']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');

    //user
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/{slug}/show', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('/{slug}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::delete('/{slug}/delete', [UserController::class, 'delete'])->name('admin.user.delete');
        Route::get('/index-datatable', [UserController::class, 'userListDataTable'])->name('admin.user.index.datatable');
        Route::put('/update', [UserController::class, 'update'])->name('admin.user.update');
        Route::put('/passwordUpdate', [UserController::class, 'updatePassword'])->name('admin.user.update.password');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
    });


    //profile
    Route::get('/profiles/create/{id}', [ProfileController::class, 'create'])->name('admin.profile.create');
    Route::put('/profiles/store', [ProfileController::class, 'store'])->name('admin.profile.store');

    //category
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::put('/update', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/index-datatable', [CategoryController::class, 'categoryListDataTable'])->name('admin.category.index.datatable');
        Route::get('/{slug}/show', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::get('/{slug}/edit/', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::delete('/{slug}/delete', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });


    //product
    Route::get('/products', [ProductController::class, 'index'])->name('admin.product.index');
    Route::put('/products/update', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/products/index-datatable', [ProductController::class, 'productListDataTable'])->name('admin.product.index.datatable');
    Route::get('/products/{slug}/show', [ProductController::class, 'show'])->name('admin.product.show');
    Route::get('/products/{slug}/edit/', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::delete('/products/{slug}/delete', [ProductController::class, 'delete'])->name('admin.product.delete');

    //product Pictures
    Route::get('/productPictures/create/{id}', [ProductPictureController::class, 'create'])->name('admin.product.picture.create');
    Route::put('/productPictures/store', [ProductPictureController::class, 'store'])->name('admin.product.picture.store');
});
