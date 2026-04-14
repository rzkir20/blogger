<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table): void {
            $table->string('slug')->nullable()->after('name');
        });

        Schema::table('tags', function (Blueprint $table): void {
            $table->string('slug')->nullable()->after('name');
        });

        $this->backfillSlugs('categories');
        $this->backfillSlugs('tags');

        Schema::table('categories', function (Blueprint $table): void {
            $table->string('slug')->nullable(false)->change();
            $table->unique('slug');
        });

        Schema::table('tags', function (Blueprint $table): void {
            $table->string('slug')->nullable(false)->change();
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });

        Schema::table('tags', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }

    private function backfillSlugs(string $table): void
    {
        $rows = DB::table($table)->select(['id', 'name'])->orderBy('id')->get();
        $used = [];

        foreach ($rows as $row) {
            $base = Str::slug((string) $row->name);
            $base = $base !== '' ? $base : 'item';
            $slug = $base;
            $counter = 2;

            while (isset($used[$slug]) || DB::table($table)->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $base.'-'.$counter;
                $counter++;
            }

            $used[$slug] = true;

            DB::table($table)->where('id', $row->id)->update([
                'slug' => $slug,
                'updated_at' => now(),
            ]);
        }
    }
};
