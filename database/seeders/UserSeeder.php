<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'id' => Str::uuid(),
            'name' => 'testadmin',
            'email' => 'testadmin@gmail.com',
            'username' => 'testadmin',
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);
    }
}
