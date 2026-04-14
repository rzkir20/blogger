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
        Schema::table('posts', function (Blueprint $table): void {
            $table->string('slug')->nullable()->after('title');
        });

        $posts = DB::table('posts')->select(['id', 'title'])->orderBy('id')->get();
        $usedSlugs = [];

        foreach ($posts as $post) {
            $baseSlug = Str::slug((string) $post->title);
            $baseSlug = $baseSlug !== '' ? $baseSlug : 'post';
            $slug = $baseSlug;
            $counter = 2;

            while (isset($usedSlugs[$slug]) || DB::table('posts')->where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $baseSlug.'-'.$counter;
                $counter++;
            }

            $usedSlugs[$slug] = true;

            DB::table('posts')->where('id', $post->id)->update([
                'slug' => $slug,
                'updated_at' => now(),
            ]);
        }

        Schema::table('posts', function (Blueprint $table): void {
            $table->string('slug')->nullable(false)->change();
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
