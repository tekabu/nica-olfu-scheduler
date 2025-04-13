<?php

use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('google')->user();
    dd($user);
})->name('google.login.callback');