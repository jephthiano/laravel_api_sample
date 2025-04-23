<?php

namespace Database\Seeders;

use App\Enums\AdminRole;
use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'role' => Role::Admin->value,
            'admin_role' => AdminRole::SuperAdmin->value,
            'password' => 'password',
            'status' => UserStatus::Active->value,
        ]);

        // 1 Logistics user
        User::factory()->create([
            'id' => Str::uuid(),
            'name' => 'logistics User',
            'email' => 'logistics@gmail.com',
            'username' => 'logistics',
            'role' => Role::Logistics->value,
            'password' => 'password',
            'status' => UserStatus::Active->value,
        ]);

        // 5 Regular users
        for ($i = 1; $i <= 5; $i++) {
            User::factory()->create([
                'id' => Str::uuid(),
                'name' => "User {$i}",
                'email' => "user{$i}@gmail.com",
                'username' => "user{$i}",
                'role' => Role::User->value,
                'password' => 'password',
                'status' => UserStatus::Active->value,
            ]);
        }
    }
}
