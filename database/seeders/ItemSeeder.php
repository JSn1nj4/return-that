<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ItemSeeder extends Seeder
{
    /**
     * @param mixed $data The input that's expected to be a list of models.
     * @return bool
     */
    private function hasUsers(mixed $data): bool
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
                default => get_class($item) === User::class,
            },
            true
        );
    }

    private function maybeAttachUsers(Collection $items, array $users): void
    {
        $items->transform(function (Item $item) use ($users) {
            if (random_int(0, 2) === 0) return;

            $item->users()->attach(Arr::random($users));
        });
    }

    /**
     * Run the database seeds.
     */
    public function run(array $dependencies = []): void
    {
        $dependencies['users'] ??= null;

        $users = match($this->hasUsers($dependencies['users'])) {
            true => $dependencies['users'],
            default => User::all()
        };

        $items = Item::factory(15)->create();

        $this->maybeAttachUsers($items, $users->all());
    }
}
