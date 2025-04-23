<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(array $data): JsonResponse
    {
        try {
            $user = $this->authRepository->getSingleUserData($data['email'], 'email');

            if (! $user) {
                return $this->sendResponse([], 'Incorrect email and password', false, [], 401);
            }

            // Verify password
            if (! Hash::check($data['password'], $user->password)) {
                return $this->sendResponse([], 'Incorrect email and password', false, [], 401);
            }

            // Generate authentication token (if using Laravel Sanctum or Passport)
            $token = $user->createToken('authToken')->plainTextToken;
            $data = ['token' => $token, 'data' => $user];

            return $this->sendResponse($data, 'Login successful', true, [], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function register(array $data): JsonResponse
    {
        try {
            $user = $this->authRepository->createUser($data);

            // Generate authentication token (if using Laravel Sanctum or Passport)
            $token = $user->createToken('authToken')->plainTextToken;
            $data = ['token' => $token, 'data' => $user];

            return $this->sendResponse($data, 'Registration successful', true, [], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function logout(array $data): JsonResponse
    {
        try {
            $request->user()->tokens()->delete();

            return $this->sendResponse([], 'Logout successful', true, [], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
