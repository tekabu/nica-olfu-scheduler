<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['guest'])->group(function () {
    Route::prefix('login')
    ->name('login.')
    ->group(function ()
    {
        Route::get('/', [LoginController::class, 'index'])->name('login');
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