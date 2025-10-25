<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home/home');
});


Route::get('product', function () {
    return view('product/product');
});

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('authors', AuthorController::class);
Route::resource('series', SeriesController::class);

