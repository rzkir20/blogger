<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['post_id', 'tag_id']);
        });

        Schema::table('posts', function (Blueprint $table): void {
            $table->foreignId('category_id')->nullable()->after('user_id')->constrained('categories')->nullOnDelete();
        });

        $posts = DB::table('posts')->select(['id', 'category', 'tags'])->get();

        foreach ($posts as $post) {
            $categoryName = trim((string) ($post->category ?? ''));

            if ($categoryName !== '') {
                $categoryId = DB::table('categories')->where('name', $categoryName)->value('id');

                if (! $categoryId) {
                    $categoryId = DB::table('categories')->insertGetId([
                        'name' => $categoryName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('posts')->where('id', $post->id)->update(['category_id' => $categoryId]);
            }

            $decodedTags = json_decode((string) $post->tags, true);
            if (! is_array($decodedTags)) {
                continue;
            }

            foreach ($decodedTags as $tagNameRaw) {
                $tagName = trim((string) $tagNameRaw);
                if ($tagName === '') {
                    continue;
                }

                $tagId = DB::table('tags')->where('name', $tagName)->value('id');
                if (! $tagId) {
                    $tagId = DB::table('tags')->insertGetId([
                        'name' => $tagName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('post_tag')->updateOrInsert(
                    ['post_id' => $post->id, 'tag_id' => $tagId],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('category_id');
        });

        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
    }
};
