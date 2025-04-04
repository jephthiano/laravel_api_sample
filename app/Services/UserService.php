<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService extends BaseService
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }
}