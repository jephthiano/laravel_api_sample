<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class AuthService extends BaseService
{
    public function login()
    {
        try {


            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'response_data' => [
                    'token' => $user->createToken('API Token')->plainTextToken,
                    'user' => $user
                ],
                'error_data' => [],
            ], 200);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}