<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TaskController;
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

Route::match(['GET', 'POST'], '/', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/sign-up', [AuthController::class, 'signUp'])->name('auth.sign_up');

Route::middleware('session.validator')->group(function () {
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/complete/{taskId}', [TaskController::class, 'completed'])->name('tasks.completed');
    });

    Route::prefix('scheduled-tasks')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('scheduled_tasks.index');
        Route::get('/add', [ScheduleController::class, 'create'])->name('scheduled_tasks.create');
        Route::post('/', [ScheduleController::class, 'save'])->name('scheduled_tasks.save');
    });
});
