<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\AuthRepository;

class AuthService extends BaseService
{
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(array $data)
    {
        try {
            //where user email is this
            $userData = $this->authRepository->getSingleUserData($data['email'], 'email');

            if(!$userData) {
                $this->sendResponse([], 'Incorrect email and password', false, [], 401);
            }

            // Verify password
            if (!Hash::check($data['password'], $user->password)) {
                $this->sendResponse([], 'Incorrect email and password', false, [], 401);
            }

            // Generate authentication token (if using Laravel Sanctum or Passport)
            // $token = $user->createToken('authToken')->plainTextToken;

            $this->sendResponse($userData, 'Login successful', true, [], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}