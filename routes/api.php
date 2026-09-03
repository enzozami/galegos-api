<?php

use Gal\Models\Auth\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login'])->name('login')->middleware(['web', 'guest']);

Route::prefix('auth')->name('auth.')->middleware(['web', 'auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
