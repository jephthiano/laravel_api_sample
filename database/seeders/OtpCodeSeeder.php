<?php

namespace Database\Seeders;

use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Database\Seeder;

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
