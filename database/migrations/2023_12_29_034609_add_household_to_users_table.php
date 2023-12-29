<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::whenTableDoesntHaveColumn('users', 'household_id', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Household::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::whenTableHasColumn('users', 'household_id', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Household::class);
            $table->removeColumn('household_id');
        });
    }
};
