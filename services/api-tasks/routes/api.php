<?php

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

Route::prefix('v1')->middleware('api.version:1')->group(function (){
    Route::prefix('auth')->group(function (){
        Route::post('/login', \App\Http\Controllers\v1\Auth\PostLoginController::class);
        Route::post('/register', \App\Http\Controllers\v1\Auth\PostRegisterController::class);
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('scheduled-tasks')->group(function (){
            Route::get('/', \App\Http\Controllers\v1\ScheduledTask\GetListController::class);
            Route::post('/', \App\Http\Controllers\v1\ScheduledTask\PostCreateController::class);
            Route::get('/resources', \App\Http\Controllers\v1\ScheduledTask\GetResourceController::class);
        });
        
        Route::prefix('tasks')->group(function (){
            Route::get('/', \App\Http\Controllers\v1\Task\GetListController::class);
            Route::get('/resources', \App\Http\Controllers\v1\Task\GetResourceController::class);
            Route::patch('/completed/{id}', \App\Http\Controllers\v1\Task\PatchStatusCompletedController::class);
        });
    });
});

