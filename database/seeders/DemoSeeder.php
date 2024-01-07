<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\Item;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\traits\TruncatesTables;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    use TruncatesTables;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::truncateAll([
            Item::make()->getTable(),
            User::make()->getTable(),
            Household::make()->getTable(),
            Role::make()->getTable(),
        ]);

        $this->call([
            UserSeeder::class,
        ]);
    }
}
