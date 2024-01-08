<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use App\Models\UserItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class UserItemSeeder extends Seeder
{
    /**
     * @param mixed $data The input that's expected to be a list of models.
     * @param string $class The name of the class to check for within.
     * @return bool
     */
    private function hasModels(mixed $data, string $class): bool
    {
        /**
         * This convoluted solution ensures a few things:
         * - we're dealing with something that can be iterated over
         * - it's not empty
         * - we're checking that the items within are objects
         * - the items are all the right type of object
         *
         * Without this, individual checks would be needed for whether
         * the argument is an array or collection. Calling `::wrap()`
         * guarantees both without more manual checking.
         */
        $prepared = Collection::wrap($data);

        if ($prepared->isEmpty()) return false;

        return array_reduce(
            $prepared->all(),
            static fn (bool $result, mixed $item): bool => match(false) {
                $result, is_object($item) => false,
                default => get_class($item) === $class,
            },
            true
        );
    }

    private function hasItems(mixed $items): bool
    {
        return $this->hasModels($items, Item::class);
    }

    private function hasUsers(mixed $items): bool
    {
        return $this->hasModels($items, User::class);
    }

    /**
     * Run the database seeds.
     */
    public function run(array $dependencies = []): void
    {
        $dependencies['items'] ??= null;

        $items = match($this->hasItems($dependencies['items'])) {
            true => $dependencies['items'],
            default => (function () {
                $this->call(ItemSeeder::class);

                return Item::all();
            })(),
        };

        $dependencies['users'] ??= null;

        $users = match($this->hasUsers($dependencies['users'])) {
            true => $dependencies['users'],
            default => User::all()
        };

        UserItem::factory(30)
            ->recycle($items)
            ->recycle($users)
            ->create();
    }
}
