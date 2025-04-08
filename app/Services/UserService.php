<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\UserRepository;

class UserService extends BaseService
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): JsonResponse
    {
        try{
            $users = $this->userRepository->getAll();

            return $this->sendResponse(UserResource::collection($users), ' Users retrieved successfully', true, [], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}