<?php

require __DIR__ . '/web_admin/admin.php';
require __DIR__ . '/web_client/client.php';

use App\Http\Controllers\Client\HomeController;
use App\Http\Middleware\WebMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(WebMiddleware::class)->group(function () {

    // Home
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/books/{id}', 'show')->name('book.show');
    });



    Route::post('/set-language', function (Request $request) {
        $lang = $request->input('locale');
        if (in_array($lang, ['tm', 'en', 'ru'])) {
            session(['locale' => $lang]);
            app()->setLocale($lang);
        }
        return back();
    })->name('set.language');
});
