<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $categories = $this->companyCategoryService->getAll();
            return $this->sendResponse('Companies retrieved successfully', $categories);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);

    //     $user = $this->userService->createUser($data);
    //     return response()->json($user, 201);
    // }
}

