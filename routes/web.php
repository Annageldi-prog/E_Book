<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\Admin\CategoryController;
use App\Http\Middleware\WebMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->middleware(WebMiddleware::class)
    ->name('home');

Route::get('/books/{id}', [HomeController::class, 'show'])->name('book.show');

Route::get('/books/{product}/buy', [HomeController::class, 'buyPage'])->name('book.buy');
Route::post('/books/{product}/buy', [HomeController::class, 'buy'])->name('book.order');

Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/my-books', [HomeController::class, 'myBooks'])->name('my.books');
Route::delete('/my-books/{order}', [HomeController::class, 'deleteOrder'])->name('my.books.delete');
Route::delete('/my-books', [HomeController::class, 'deleteAllOrders'])->name('my.books.deleteAll');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [HomeController::class, 'confirmCheckout'])->name('checkout.confirm');



