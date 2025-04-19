<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    Route::get('/login/test', [LoginController::class, 'test']);
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', function ()
{
    return '';
})->name('profile');