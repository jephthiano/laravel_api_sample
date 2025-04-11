<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Exception;

class UserController extends BaseController
{
    use AuthorizesRequests;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        try {
            // Only allow admin to view all users
            $this->authorize('viewAll', User::class);

            return $this->userService->getAllUsers();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            
            $user = User::findOrFail($id);
            $this->authorize('view', $user);

            return $this->userService->getSingleUserData($id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(UserRequest $request, $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('update', $user);

            $data = $request->only(['name', 'email', 'username']);
            return $this->userService->updateUser($id, $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('delete', $user);

            $this->userService->deleteUser($id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
