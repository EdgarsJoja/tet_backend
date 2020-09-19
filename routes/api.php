<?php

use App\Http\Controllers\Api\V1\CurrencyController;
use App\Http\Controllers\Api\V1\CurrencyListController;
use App\Http\Middleware\Api;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([Api::class])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('currency')->group(function () {
            Route::get('list', CurrencyListController::class);
            Route::get('{id}', CurrencyController::class);
        });
    });
});
