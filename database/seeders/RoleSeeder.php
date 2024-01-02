<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private array $roles = [
        ['name' => 'super-admin'],
        ['name' => 'unassigned'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
