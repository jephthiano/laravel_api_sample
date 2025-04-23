<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserService extends BaseService
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): JsonResponse
    {
        try {
            $users = $this->userRepository->getAll();

            return $this->sendResponse(UserResource::collection($users), ' Users retrieved successfully', true, [], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSingleUserData(string $id, string $type = 'id'): JsonResponse
    {
        try {
            $users = $this->userRepository->getSingleUserData($id, $type);

            return $this->sendResponse($users, ' User retrieved successfully', true, [], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function updateUser(string $id, array $data): JsonResponse
    {
        try {
            $user = $this->userRepository->getSingleUserData($id);

            if (! $user) {
                return $this->sendResponse([], 'User not found', false, [], 404);
            }

            $user = $this->userRepository->updateUser($id, $data);

            return $this->sendResponse(new UserResource($user), 'User updated successfully', true, [], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function deleteUser(string $id): JsonResponse
    {
        try {
            $user = $this->userRepository->getSingleUserData($id);

            if (! $user) {
                return $this->sendResponse([], 'Account not found', false, [], 404);
            }

            $this->userRepository->deleteUser($id);

            return $this->sendResponse(new UserResource($user), 'Account deleted successfully', true, [], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
