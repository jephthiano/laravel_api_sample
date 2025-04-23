<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_created_using_factory_and_exists_in_database()
    {
        // Act: create a user using the factory
        $user = User::factory()->create();

        // Assert: check if the user exists in the database by email
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);

        // Additional assertions
        $this->assertInstanceOf(User::class, $user);
        $this->assertNotNull($user->name);
    }
}