<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthService;
use App\Exceptions\CustomApiException;
use Exception;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user = $this->authService->register($data);

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
                'response_data' => [
                    'token' => $user->createToken('API Token')->plainTextToken,
                    'user' => $user
                ],
                'error_data' => [],
            ], 201);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Log in a user.
    */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            return $this->authService->login($credentials);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

}
