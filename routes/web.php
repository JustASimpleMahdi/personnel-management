<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeReportController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerReportController;
use App\Http\Controllers\ManagerUserController;
use App\Http\Controllers\PurchasingManagerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('file')->group(function () {
   Route::get('/report/{file}',[FileController::class,'reportFile'])->name('file.report');
});

Route::middleware('auth')->group(function () {
    Route::resource('reports', EmployeeReportController::class);
    Route::prefix('purchasing-manager')->group(function () {
        Route::get('/',[PurchasingManagerController::class,'index'])->name('purchasing-manager.index');
    });
    Route::prefix('manager')->group(function () {
        Route::get('/reports/{report}/delete', [ManagerReportController::class, 'delete'])->name('manager.reports.delete');
        Route::resource('reports', ManagerReportController::class)->except(['show'])->names('manager.reports');
        Route::get('/users/{user}/delete', [ManagerUserController::class,'delete'])->name('manager.users.delete');
        Route::resource('users', ManagerUserController::class)->except(['show'])->names('manager.users');
        Route::get('/',[ManagerController::class,'index'])->name('manager.index');
    });
    Route::put('/profile',[AuthController::class,'update'])->name('auth.profile.update');
    Route::get('/profile',[AuthController::class,'profile'])->name('auth.profile');
});

/* Authentication */
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', fn()=> view('auth.forgot-password'))->name('forgot-password');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login-submit');
});
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/welcome', fn() => view('welcome'))->name('welcome');

Route::get('/', fn() => redirect()->route('welcome'));
