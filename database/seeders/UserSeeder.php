<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private function maybeCreateSuperAdmin(): void
    {
        $admin_email = 'dev@' . config('app.domain');

        if (User::where('email', $admin_email)->exists()) return;

        User::factory()->createOne([
            'name' => 'Dev Admin',
            'email' => $admin_email,
        ]);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->maybeCreateSuperAdmin();

        User::factory(10)
            ->recycle(Household::factory(3)->create())
            ->create();
    }
}
