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
], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

Route::group(['middleware' => 'auth:api', 'prefix' => 'calendar'], function () {
    Route::get('/getTaskByUser', [CalendarController::class, 'getTaskByUser']);
    Route::post('/store', [CalendarController::class, 'store'])->name('store');
    Route::put('/edit/{id}', [CalendarController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [CalendarController::class, 'destroy'])->name('delete');
    Route::get('/get', [CalendarController::class, 'index']);
    Route::get('/{date}', [CalendarController::class, 'show']);
});
