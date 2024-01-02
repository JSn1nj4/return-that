<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\Role;
use App\Models\User;
use Database\Traits\TruncatesTables;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoSeeder extends Seeder
{
    use TruncatesTables;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::truncateAll([
            User::make()->getTable(),
            Household::make()->getTable(),
            Role::make()->getTable(),
        ]);

        $this->call([
            UserSeeder::class,
        ]);
    }
}
