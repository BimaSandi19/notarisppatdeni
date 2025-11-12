<?php
// File: routes/web.php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\AuthenticateUser;

// profile
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/index', function () {
    return redirect()->route('landing.index');
});
Route::get('/service', [LandingController::class, 'service'])->name('landing.service');
Route::get('/about', [LandingController::class, 'about'])->name('landing.about');
Route::get('/gallery', [LandingController::class, 'gallery'])->name('landing.gallery');
Route::post('/send-proses', [LandingController::class, 'send'])->name('send-proses');

//login
Route::middleware('guest')->group(function () {
    // auth routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-proses', [AuthController::class, 'login_proses'])->name('login-proses')->middleware('throttle:10,1');

    // Forgot password
    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email')->middleware('throttle:3,10');

    // Reset password
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update')->middleware('throttle:5,10');
});

//logout
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout-proses');

// middleware
// admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', AuthenticateUser::class], 'as' => 'admin.'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/reminder', [AdminController::class, 'reminder'])->name('reminder');
    Route::get('/history', [AdminController::class, 'history'])->name('history');
    // tambahReminder
    Route::post('/store', [AdminController::class, 'store'])->name('reminder-store');
    // editReminder
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('reminder-edit');
    // simpanEditReminder
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('reminder-update');
    // hapusReminder
    Route::put('/delete/{id}', [AdminController::class, 'destroy'])->name('reminder-delete');
    // approveReminder
    Route::put('/approve/{id}', [AdminController::class, 'approve'])->name('reminder-approve');

    // Export routes
    Route::get('/history/export/excel', [AdminController::class, 'exportHistoryExcel'])->name('history.export.excel');
    Route::get('/history/export/pdf', [AdminController::class, 'exportHistoryPdf'])->name('history.export.pdf');
    Route::get('/history/print', [AdminController::class, 'printHistory'])->name('history.print');

    // Quick stats untuk modal dashboard
    Route::get('/dashboard/quick-stats', [AdminController::class, 'getQuickStats'])->name('dashboard.quick-stats');

    // notifikasi

    // cetak-pdf (deprecated - kept for backward compatibility)
    Route::get('/get-all-history', [AdminController::class, 'getAllHistory'])->name('get-all-history');

    // Menangani error ketika route tidak didefinisikan di dalam grup admin
    Route::fallback(function () {
        abort(404);
    });
});

// Menangani error ketika route tidak didefinisikan di luar grup admin
Route::fallback(function () {
    abort(404);
});

Route::get('/run-schedule', function () {
    Artisan::call('schedule:run');
    return 'Schedule run executed';
});
