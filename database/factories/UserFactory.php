<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'username' => fake()->unique()->userName(),
            'country' => $this->faker->country(),
            'is_admin' => false,
            'role' => Role::User->value,
            'admin_role' => null,
            'birthdate' => fake()->date(),
            'avatar' => fake()->imageUrl(640, 480, 'people'),
            'provider' => null,
            'provider_id' => null,
            'enable_2fa' => fake()->boolean(),
            'status' => fake()->randomElement(UserStatus::values()),
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
