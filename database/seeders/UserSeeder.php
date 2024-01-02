<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection<\App\Models\Role>
     */
    private Collection $roles;

    private function initRoles(): void
    {
        $this->call(RoleSeeder::class);

        $this->roles = Role::all();
    }

    private function pickRole(\App\Enums\Role $enum): Role
    {
        return $this->roles
            ->where('name', $enum->value)
            ->first();
    }

    private function maybeCreateSuperAdmin(): void
    {
        $admin_email = 'dev@' . config('app.domain');

        if (User::where('email', $admin_email)->exists()) return;

        User::factory()
            ->state([
                'role_id' => $this->pickRole(\App\Enums\Role::SuperAdmin)->id,
                'name' => 'Dev Admin',
                'email' => $admin_email,
            ])
            ->createOne();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->initRoles();

        $this->maybeCreateSuperAdmin();

        User::factory(10)
            ->recycle(Household::factory(3)->create())
            ->create();
    }
}
