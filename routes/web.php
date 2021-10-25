<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function() {
        Route::get('', [\App\Http\Controllers\UserController::class, 'index']);
        Route::put('bulk', [\App\Http\Controllers\UserController::class, 'bulkUpdate']);
        Route::delete('bulk', [\App\Http\Controllers\UserController::class, 'bulkDelete']);
        Route::get('{user}', [\App\Http\Controllers\UserController::class, 'show']);
        Route::put('{user}', [\App\Http\Controllers\UserController::class, 'update']);
        Route::delete('{user}', [\App\Http\Controllers\UserController::class, 'delete']);
    });
});

require __DIR__.'/auth.php';
