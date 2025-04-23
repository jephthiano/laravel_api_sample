<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only(['email', 'password']);

            return $this->authService->login($credentials);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Register a new user.
     */
    public function register(AuthRequest $request): JsonResponse
    {
        try {
            $data = $request->only(['name', 'email', 'username', 'password']);

            return $this->authService->register($data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function logout(): JsonResponse
    {
        return $this->authService->logout();
    }
}
