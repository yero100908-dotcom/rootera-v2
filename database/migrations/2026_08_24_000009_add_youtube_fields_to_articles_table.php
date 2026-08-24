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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('youtube_video_id')->nullable()->unique()->after('views');
            $table->string('video_embed_url')->nullable()->after('youtube_video_id');
            $table->enum('post_type', ['article', 'video_guide'])->default('article')->after('video_embed_url');
            $table->string('category')->nullable()->default('Artikel')->after('post_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['youtube_video_id', 'video_embed_url', 'post_type', 'category']);
        });
    }
};
