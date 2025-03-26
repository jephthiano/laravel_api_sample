<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class AuthRepository extends BaseRepository
{
    public function getUser(): User|Collection
    {
        try{
            return User::all();
            
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSingleUserData(string $param, string $type='id'): ?User
    {
        try {
            return User::where($type, $param)->first();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function createUser(array $data)
    {
        try {
            return User::create($data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}