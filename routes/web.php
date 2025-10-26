<?php
use App\Http\Controllers\HomeController;
use App\Http\Middleware\WebMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->middleware(WebMiddleware::class)
    ->name('home');




