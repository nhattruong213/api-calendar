<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CalendarController;
use Illuminate\Http\Request;
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

Route::group([

    'middleware' => 'api',
    // 'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/store', [CalendarController::class, 'store'])->name('store');
    Route::delete('/{id}', [CalendarController::class, 'destroy'])->name('delete');
    Route::put('/edit/{id}', [CalendarController::class, 'update'])->name('update');
});

Route::get('/test', [CalendarController::class, 'index']);
Route::get('/{id}', [CalendarController::class, 'show']);