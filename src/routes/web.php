<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('schedules')
    ->name('schedules.')
    ->group(function ()
    {
        Route::get('/', [ScheduleController::class, 'index'])->name('index');
        Route::get('/create', [ScheduleController::class, 'createSchedule'])->name('create');
        Route::post('/store', [ScheduleController::class, 'storeSchedule'])->name('store');
        Route::get('/{schedule}/edit', [ScheduleController::class, 'editSchedule'])->name('edit');
        Route::post('/{schedule}/update', [ScheduleController::class, 'updateSchedule'])->name('update');
        Route::delete('/{schedule}/delete', [ScheduleController::class, 'deleteSchedule'])->name('delete');
    });
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');

    Route::prefix('login')
    ->name('login.')
    ->group(function ()
    {    
        Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
        Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
        Route::get('/test', [LoginController::class, 'test'])->name('test');
    });
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', function ()
{
    return '';
})->name('profile');