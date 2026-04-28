<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('ai_configurations')) {
            return;
        }

        DB::statement('ALTER TABLE `ai_configurations` MODIFY `ai_key` TEXT NOT NULL');
    }

    public function down(): void
    {
        if (! Schema::hasTable('ai_configurations')) {
            return;
        }

        DB::statement('ALTER TABLE `ai_configurations` MODIFY `ai_key` VARCHAR(255) NOT NULL');
    }
};
