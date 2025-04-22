<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\UserStatus;

class OtpCodeSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::take(3)->get();
        
        foreach ($users as $user) {
            OtpCode::factory()->create([
                'receiving_medium' => $user->email,
            ]);
        }
    }
}