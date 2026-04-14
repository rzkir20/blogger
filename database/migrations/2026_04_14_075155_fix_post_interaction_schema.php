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
        if (Schema::hasTable('post_interaction_tables')) {
            Schema::drop('post_interaction_tables');
        }

        if (! Schema::hasTable('view_list')) {
            Schema::create('view_list', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
                $table->timestamps();

                $table->unique(['user_id', 'post_id']);
            });
        }

        if (! Schema::hasTable('like_list')) {
            Schema::create('like_list', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
                $table->timestamps();

                $table->unique(['user_id', 'post_id']);
            });
        }

        if (! Schema::hasTable('comments_list')) {
            Schema::create('comments_list', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
                $table->text('comment');
                $table->timestamps();
            });
        }

        if (Schema::hasColumn('posts', 'views') || Schema::hasColumn('posts', 'likes') || Schema::hasColumn('posts', 'comments')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn(['views', 'likes', 'comments']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments_list');
        Schema::dropIfExists('like_list');
        Schema::dropIfExists('view_list');
    }
};
