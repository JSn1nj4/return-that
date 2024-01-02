<?php

namespace App\Enums;

enum Role: string
{
    case SuperAdmin = 'super-admin';
    case Unassigned = 'unassigned';

    public function can(Permission $permission): bool
    {
        return in_array($permission, $this->permissions());
    }

    public function label(): string
    {
        return match($this) {
            self::SuperAdmin => 'Super Admin',
            self::Unassigned => 'Unassigned',
            default => 'Unknown',
        };
    }

    public function permissions(): array
    {
        return match($this) {
            self::SuperAdmin => [Permission::AdminApplication],
            default => [Permission::None],
        };
    }
}
