<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserRepository extends BaseRepository
{
    public function getAll(int $perPage = 10)
    {
        try{
            return User::paginate($perPage);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSingleUserData(string $param, string $type='id')
    {
        try {
            return User::where($type, $param)->first();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    
    public function updateUser(string $id, array $data): User|null
    {
        try {
            $user = User::findOrFail($id);
            $user->update($data);
            return $user;
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return true;
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}