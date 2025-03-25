<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;



Route::prefix('v1')->group(function () {
    require __DIR__ . '/api/auth.php';
    // require __DIR__ . '/api/user.php';
    
    Route::get('*', function () {
        return response()->json([
            'status' => true,
            'message' => 'Invalid request',
            'response_data' => [],
            'error_data' => [],
        ], 200);
    });  




















































    
});
