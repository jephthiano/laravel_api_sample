<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use Exception;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->getAll();
            return $this->sendResponse('Users retrieved successfully', UserResource::collection($users));
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
    public function show($id): JsonResponse
    {
        try {
            $user = $this->userService->getSingleUserData($id);
            return $this->sendResponse('User retrieved successfully', new UserResource($user));
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
    public function update(UserRequest $request, $id): JsonResponse
    {
        try {
            $data = $request->only(['name', 'email', 'username']);
            $user = $this->userService->updateUser($id, $data);
            return $this->sendResponse('User updated successfully', new UserResource($user));
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
    public function destroy($id): JsonResponse
    {
        try {
            $this->userService->deleteUser($id);
            return $this->sendResponse('User deleted successfully');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}

