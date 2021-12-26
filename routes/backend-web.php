<?php

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductPictureController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\TransactionController;
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
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        Route::put('/update/{slug}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/index-datatable', [ProductController::class, 'productListDataTable'])->name('admin.product.index.datatable');
        Route::get('/{slug}/show', [ProductController::class, 'show'])->name('admin.product.show');
        Route::get('/{slug}/edit/', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::delete('/{slug}/delete', [ProductController::class, 'delete'])->name('admin.product.delete');
        Route::post('/product/upload/picture', [ProductController::class, 'uploadPicture'])->name('admin.product.upload.picture');
        Route::post('/product/picture/delete/{id}', [ProductController::class, 'deletePicture'])->name('admin.product.picture.delete');
    });

    //transactions
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', [TransactionController::class, 'index'])->name('admin.transaction.index');
        Route::get('/{id}/process', [TransactionController::class, 'setOnProccess'])->name('admin.transaction.process');
        Route::get('/{id}/confirm', [TransactionController::class, 'setConfirmed'])->name('admin.transaction.confirmed');
        Route::get('/{id}/delivery', [TransactionController::class, 'setDelivery'])->name('admin.transaction.delivery');
        Route::get('/{id}/done', [TransactionController::class, 'setDone'])->name('admin.transaction.done');
        Route::get('/{id}/cancel', [TransactionController::class, 'setCancel'])->name('admin.transaction.canceled');
        Route::get('/{id}/show', [TransactionController::class, 'showTransaction'])->name('admin.transaction.show');
    });
});
