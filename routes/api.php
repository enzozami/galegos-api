<?php

use Gal\Models\Auth\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->middleware(['web', 'guest'])->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');;
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('verify-code', [AuthController::class, 'verifyCode'])->name('verify-code');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
});

Route::prefix('auth')->name('auth.')->middleware(['web', 'auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
