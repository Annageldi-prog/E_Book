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

// УБРАНО middleware('auth')
// Покупка доступна без логина
Route::prefix('buy')
    ->name('buy.')
    ->controller(BuyController::class)
    ->group(function () {
        Route::get('{product}', 'buyPage')->name('page');
        Route::post('{product}', 'buy')->name('store');
    });

// УБРАНО auth
Route::prefix('checkout')
    ->name('checkout.')
    ->controller(CheckoutController::class)
    ->group(function () {
        Route::get('', 'checkout')->name('index');
        Route::post('', 'confirmCheckout')->name('confirm');
    });

// УБРАНО auth
Route::prefix('my-books')
    ->name('mybooks.')
    ->controller(MyBooksController::class)
    ->group(function () {
        Route::get('', 'myBooks')->name('index');
        Route::delete('{order}', 'deleteOrder')->name('delete');
        Route::delete('', 'deleteAllOrders')->name('deleteAll');
    });

// УБРАНО auth
Route::prefix('favorites')
    ->name('favorites.')
    ->controller(FavoriteController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('{product}', 'toggle')->name('toggle');
    });

// УБРАНО auth
Route::prefix('reviews/{product}')
    ->name('reviews.')
    ->controller(ReviewController::class)
    ->group(function () {
        Route::post('', 'store')->name('store');
        Route::delete('{review}', 'destroy')->name('destroy');
    });

Route::prefix('authors')
    ->name('authors.')
    ->controller(AuthorController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
    });

Route::prefix('series')
    ->name('series.')
    ->controller(SeriesController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
    });
