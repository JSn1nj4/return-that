<?php

namespace App\Enums;

enum Permission: string
{
    case AdminApplication = 'admin-application';
    case None = 'none';

    public function description(): string
    {
        return match($this) {
            self::AdminApplication => 'User can do administration at the admin level.',
            default => 'User has no permissions.',
        };
    }
}
