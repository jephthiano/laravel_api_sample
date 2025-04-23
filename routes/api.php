<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require __DIR__.'/api/auth.php';
    require __DIR__.'/api/user.php';

    Route::get('*', function () {
        return response()->json([
            'status' => false,
            'message' => 'Invalid request',
            'response_data' => [],
            'error_data' => [],
        ], 404);
    });
});
