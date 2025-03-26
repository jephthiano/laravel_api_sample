<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// use App\Http\Controllers\Api\AdminController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    // Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});