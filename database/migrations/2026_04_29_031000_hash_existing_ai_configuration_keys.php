<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('ai_configurations')) {
            return;
        }

        DB::table('ai_configurations')
            ->select(['id', 'ai_key'])
            ->orderBy('id')
            ->chunkById(100, function ($rows): void {
                foreach ($rows as $row) {
                    $key = (string) ($row->ai_key ?? '');

                    if ($key === '') {
                        continue;
                    }

                    // Skip if key already stored as password hash.
                    if (password_get_info($key)['algo'] !== null) {
                        continue;
                    }

                    DB::table('ai_configurations')
                        ->where('id', $row->id)
                        ->update([
                            'ai_key' => Hash::make($key),
                        ]);
                }
            }, 'id');
    }

    public function down(): void
    {
        // Cannot safely reverse hashed secret values back to plaintext.
    }
};
