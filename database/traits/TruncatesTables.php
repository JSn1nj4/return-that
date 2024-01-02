<?php

namespace Database\Traits;

use Illuminate\Support\Facades\DB;

trait TruncatesTables
{
    public static function truncate(string $table): void
    {
        DB::table($table)->truncate();
    }

    public static function truncateAll(array $tables): void
    {
        foreach ($tables as $table) {
            self::truncate($table);
        }
    }
}
