<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\UserStatus;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1 Admin user
        User::factory()->create([
            'id' => Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'is_admin' => true,
            'password' => Hash::make('password'),
            'status' => UserStatus::Active->value,
        ]);

        // 5 Regular users
        for ($i = 1; $i <= 5; $i++) {
            User::factory()->create([
                'id' => Str::uuid(),
                'name' => "User {$i}",
                'email' => "user{$i}@gmail.com",
                'username' => "user{$i}",
                'password' => Hash::make('password'),
                'status' => UserStatus::Active->value,
            ]);
        }
    }
}
