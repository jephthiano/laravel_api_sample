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
    public function register(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'username' => 'required|string|max:10|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            return $this->authService->register($data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Log in a user.
    */
    public function login(Request $request): JsonResponse
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
