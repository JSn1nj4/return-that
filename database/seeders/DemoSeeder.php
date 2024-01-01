<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(User::make()->getTable())->truncate();

        DB::table(Household::make()->getTable())->truncate();

        $this->call([
            UserSeeder::class,
        ]);
    }
}
