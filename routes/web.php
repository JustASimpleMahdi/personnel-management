<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/* Authentication */
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', fn()=> view('auth.forgot-password'))->name('forgot-password');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login-submit');
});
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/', fn() => view('welcome'))->name('welcome');
