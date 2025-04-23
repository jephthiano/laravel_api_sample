<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Api\AdminController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('auth.logout');
});
