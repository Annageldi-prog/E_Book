<?php
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)
    ->group(function () {
        Route::get('', 'index')->name('home');
    });

Route::prefix('v1/admin')->name('v1.admin.')->group(function () {
    // Показать страницу логина
    Route::get('/login', [AuthController::class, 'create'])
        ->middleware('guest')
        ->name('login');

    // Обработка формы логина
    Route::post('/login', [AuthController::class, 'store'])
        ->middleware('guest')
        ->name('login.store');

    // Dashboard (только для авторизованных)
    Route::middleware('auth')->prefix('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('auth.dashboard');

        // Logout
        Route::post('/logout', [AuthController::class, 'destroy'])
            ->name('auth.logout');
    });
});
