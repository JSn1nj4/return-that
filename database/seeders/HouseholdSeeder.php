<?php

namespace Database\Seeders;

use App\Models\Household;
use Illuminate\Database\Seeder;

class HouseholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Household::factory(5)->create();
    }
}
