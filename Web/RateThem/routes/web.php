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

Route::prefix('admin')->middleware('admin')->namespace('\App\Http\Controllers\Back')->group(function () {
    Route::get('/', [\App\Http\Controllers\Back\AdminController::class, 'index'])->name('admin');

    Route::resource('days', DaysController::class)->except('show')->parameters([
        'day' => 'day'
    ]);
    Route::get('days/{day}', [\App\Http\Controllers\Back\DaysController::class, 'alert'])->name('days.destroy.alert');
    Route::resource('users', UsersController::class)->except('show')->parameters([
        'user' => 'user'
    ]);
    Route::get('users/{day}', [\App\Http\Controllers\Back\UsersController::class, 'alert'])->name('users.destroy.alert');
});

