<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use App\Models\UserItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class UserItemSeeder extends Seeder
{
    private function prepareDependencies(array $dependencies): array
    {
        return [
            match(empty($dependencies['items'])) {
                false => $dependencies['items'],
                true => (function () {
                    $this->call(ItemSeeder::class);

                    return Item::all();
                })(),
            },

            $dependencies['users'] ?? User::all(),
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(array $dependencies): void
    {
        [$items, $users] = $this->prepareDependencies($dependencies);

        UserItem::factory(30)
            ->recycle($items)
            ->recycle($users)
            ->create();
    }
}
