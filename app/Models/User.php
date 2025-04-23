<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'country',
        'avatar',
        'birthdate',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Accessor & Mutator for the 'name' attribute.
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value),
        );
    }

    /**
     * Accessor for the 'email' attribute.
     */
    public function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtolower($value),
            set: fn ($value) => strtolower($value),
        );
    }

    /**
     * Mutator for the 'password' attribute using Laravel's Hash facade.
     */
    public function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    /**
     * Scope a query to only include active users.
     */
    #[Scope]
    public function admin($query)
    {
        $query->where('is_admin', true);
    }

    /**
     * Scope a query to only include active users.
     */
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('status', 'active');
    }

    /**
     * Scope a query to only include suspended users.
     */
    #[Scope]
    protected function suspended(Builder $query): void
    {
        $query->where('status', 'suspended');
    }

    /**
     * Scope a query to only include suspended users.
     */
    #[Scope]
    protected function verify(Builder $query): void
    {
        $query->whereNotNull('email_verified_at');
    }

    /**
     * Scope a query to only include inactive users.
     */
    #[Scope]
    public function inactive($query, $days)
    {
        $query->where('last_login_at', '<=', now()->subDays($days));
    }

    /**
     * Scope a query to only include recently registered users.
     */
    #[Scope]
    public function recentlyRegistered($query, $days)
    {
        $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope a query to only include admin with passed role.
     */
    #[Scope]
    public function adminRole($query, $type)
    {
        $query->where('admin_role', $type)->where('is_admin', true);
    }

    /**
     * Scope a query to only include user with passed role.
     */
    #[Scope]
    public function role($query, $type)
    {
        $query->where('role', $type);
    }

    /**
     * Scope a query to only include user from specific country.
     */
    #[Scope]
    public function fromCountry($query, $country)
    {
        $query->where('country', $country);
    }
}
