<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('region', 120)->nullable()->after('bio');
            $table->string('twitter_url')->nullable()->after('region');
            $table->string('instagram_url')->nullable()->after('twitter_url');
            $table->string('website_url')->nullable()->after('instagram_url');
            $table->string('avatar_path')->nullable()->after('website_url');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['region', 'twitter_url', 'instagram_url', 'website_url', 'avatar_path']);
        });
    }
};
