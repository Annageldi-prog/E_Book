<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\Admin\CategoryController;
use App\Http\Controllers\Web\Admin\FavoriteController;
use App\Http\Controllers\Web\Admin\ReviewController;
use App\Http\Middleware\WebMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware(WebMiddleware::class)->group(function () {

    // Главная и книги
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');               // Главная страница
        Route::get('/load-more', 'loadMore')->name('books.loadMore'); // AJAX "Показать ещё"
        Route::get('/books/{id}', 'show')->name('book.show'); // Страница книги
        Route::post('/books/{product}/buy', 'buy')->name('book.order'); // Добавление в корзину
        Route::get('/books/{product}/buy', 'buyPage')->name('book.buy'); // Страница покупки
    });

    // Категории
    Route::controller(CategoryController::class)
        ->prefix('category')
        ->name('category.')
        ->group(function () {
            Route::get('{id}', 'show')->name('show');
        });

    // Мои книги (название маршрута теперь my.books.index)
    Route::controller(HomeController::class)
        ->prefix('my-books')
        ->name('my.books.')
        ->middleware('auth')
        ->group(function () {
            Route::get('', 'myBooks')->name('index');             // my.books.index
            Route::delete('{order}', 'deleteOrder')->name('delete');
            Route::delete('', 'deleteAllOrders')->name('deleteAll');
        });

    // Checkout
    Route::controller(HomeController::class)
        ->prefix('checkout')
        ->name('checkout.')
        ->middleware('auth')
        ->group(function () {
            Route::get('', 'checkout')->name('index');           // checkout.index
            Route::post('', 'confirmCheckout')->name('confirm'); // checkout.confirm
        });

    // Отзывы
    Route::controller(ReviewController::class)
        ->prefix('products/{product}/reviews')
        ->name('reviews.')
        ->middleware('auth')
        ->group(function () {
            Route::post('', 'store')->name('store');
            Route::delete('/{review}', 'destroy')->name('destroy');
        });

    // Любимые
    Route::controller(FavoriteController::class)
        ->prefix('favorites')
        ->name('favorites.')
        ->middleware('auth')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('{product}', 'toggle')->name('toggle');
        });

    // Локализация
    Route::post('/set-language', function (Request $request) {
        $lang = $request->input('locale');
        if (in_array($lang, ['tm', 'en', 'ru'])) {
            session(['locale' => $lang]);
            app()->setLocale($lang);
        }
        return back();
    })->name('set.language');

});
