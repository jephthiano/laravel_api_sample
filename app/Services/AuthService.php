<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class AuthService extends BaseService
{
    public function login($data)
    {
        try {
            //get the password where user email is this

            //validate the email

            //get user data and send back in response
            $userData = [];

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'response_data' => $userData,
                'error_data' => [],
            ], 200);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}