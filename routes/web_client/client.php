<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\BuyController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\MyBooksController;
use App\Http\Controllers\Client\FavoriteController;
use App\Http\Controllers\Client\ReviewController;
use App\Http\Controllers\Client\AuthorController;
use App\Http\Controllers\Client\SeriesController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('books')
    ->name('books.')
    ->controller(ProductController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{product}', 'show')->name('show');
    });

Route::prefix('category')
    ->name('category.')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{id}', 'show')->name('show');
    });

Route::controller(BuyController::class)
    ->middleware('auth')
    ->prefix('buy')
    ->name('buy.')
    ->group(function () {
        Route::get('{product}', 'buyPage')->name('page');
        Route::post('{product}', 'buy')->name('store');
    });

Route::middleware('auth')
    ->prefix('checkout')
    ->name('checkout.')
    ->controller(CheckoutController::class)
    ->group(function () {
        Route::get('', 'checkout')->name('index');
        Route::post('', 'confirmCheckout')->name('confirm');
    });

Route::middleware('auth')
    ->prefix('my-books')
    ->name('mybooks.')
    ->controller(MyBooksController::class)
    ->group(function () {
        Route::get('', 'myBooks')->name('index');
        Route::delete('{order}', 'deleteOrder')->name('delete');
        Route::delete('', 'deleteAllOrders')->name('deleteAll');
    });

Route::middleware('auth')
    ->controller(FavoriteController::class)
    ->prefix('favorites')
    ->name('favorites.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('{product}', 'toggle')->name('toggle');
    });

Route::middleware('auth')
    ->controller(ReviewController::class)
    ->prefix('reviews/{product}')
    ->name('reviews.')
    ->group(function () {
        Route::post('', 'store')->name('store');
        Route::delete('{review}', 'destroy')->name('destroy');
    });

Route::controller(AuthorController::class)
    ->prefix('authors')
    ->name('authors.')
    ->group(function () {
        Route::get('', 'index')->name('index');
    });

Route::controller(SeriesController::class)
    ->prefix('series')
    ->name('series.')
    ->group(function () {
        Route::get('', 'index')->name('index');
    });
