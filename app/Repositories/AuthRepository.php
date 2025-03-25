<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class AuthRepository extends BaseRepository
{
    public function getUser()
    {
        return User::all();
    }
}