<?php

namespace App\Enums;

enum Role: string
{
    case SuperAdmin = 'super-admin';
    case Unassigned = 'unassigned';

    public function label(): string
    {
        return match($this) {
            self::SuperAdmin => 'Super Admin',
            self::Unassigned => 'Unassigned',
            default => 'Unknown',
        };
    }
}
