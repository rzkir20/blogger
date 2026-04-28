<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('ai_configurations')) {
            return;
        }

        Schema::table('ai_configurations', function (Blueprint $table) {
            if (! Schema::hasColumn('ai_configurations', 'status')) {
                $table->string('status', 20)->default('draft')->after('ai_key');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('ai_configurations') || ! Schema::hasColumn('ai_configurations', 'status')) {
            return;
        }

        Schema::table('ai_configurations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
