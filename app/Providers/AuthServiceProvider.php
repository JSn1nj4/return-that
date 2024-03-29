<?php

namespace App\Providers;

use App\Enums\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define(Permission::AdminApplication->value, static function (User $user) {
            if ($user->role === null) return false;

            return $user->role->enum()->can(Permission::AdminApplication);
        });
    }
}
