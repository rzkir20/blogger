<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'bio', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    public const ROLE_READER = 'reader';

    public const ROLE_WRITER = 'writer';

    public const ROLE_SUPER_ADMIN = 'super_admin';

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Normalize role from DB (toleran: super-admin, Super Admin, spasi, dll.).
     */
    public function normalizedRole(): string
    {
        $raw = strtolower(trim((string) $this->role));

        return str_replace(['-', ' '], '_', $raw);
    }

    public function isSuperAdmin(): bool
    {
        return $this->normalizedRole() === self::ROLE_SUPER_ADMIN;
    }

    public function dashboardRouteName(): string
    {
        return match ($this->normalizedRole()) {
            self::ROLE_SUPER_ADMIN => 'dashboard',
            self::ROLE_WRITER => 'writer.home',
            default => 'reader.home',
        };
    }
}
