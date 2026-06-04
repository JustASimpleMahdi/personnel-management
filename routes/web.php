<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DefaultPanelController;
use App\Http\Controllers\EmployeeReportController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ManagerAnnouncementController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerReportController;
use App\Http\Controllers\ManagerUserController;
use App\Http\Controllers\WorkHourController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('file')->group(function () {
    Route::get('/report/{file}', [FileController::class, 'reportFile'])->name('file.report');
});

Route::middleware('auth')->group(function () {

    Route::post('/work-hours', [WorkHourController::class, 'store'])->name('work-hours.store');
    Route::get('/work-hours', [WorkHourController::class, 'index'])->name('work-hours.index');

    Route::resource('reports', EmployeeReportController::class)
        ->middleware('role:accountant,cashier,sales-manager,purchasing-manager');

    Route::get('/accountant', [DefaultPanelController::class, 'index'])->middleware('role:accountant')->name('accountant.index');
    Route::get('/cashier', [DefaultPanelController::class, 'index'])->middleware('role:cashier')->name('cashier.index');
    Route::get('/sales-manager', [DefaultPanelController::class, 'index'])->middleware('role:sales-manager')->name('sales-manager.index');
    Route::get('/purchasing-manager', [DefaultPanelController::class, 'index'])->middleware('role:purchasing-manager')->name('purchasing-manager.index');

    Route::prefix('manager')->middleware(['role:manager'])->group(function () {
        Route::get('/announcements/{announcement}/delete', [ManagerAnnouncementController::class, 'delete'])->name('manager.announcements.delete');
        Route::resource('announcements', ManagerAnnouncementController::class)->names('manager.announcements');

        Route::get('/reports/{report}/delete', [ManagerReportController::class, 'delete'])->name('manager.reports.delete');
        Route::resource('reports', ManagerReportController::class)->except(['show'])->names('manager.reports');

        Route::get('/users/{user}/delete', [ManagerUserController::class, 'delete'])->name('manager.users.delete');
        Route::resource('users', ManagerUserController::class)->except(['show'])->names('manager.users');

        Route::get('/', [ManagerController::class, 'index'])->name('manager.index');
    });
    Route::put('/profile', [AuthController::class, 'update'])->name('auth.profile.update');
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');
});

/* Authentication */
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('forgot-password');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login-submit');
});
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/welcome', fn() => view('welcome'))->name('welcome');

Route::get('/', fn() => redirect()->route('welcome'));
