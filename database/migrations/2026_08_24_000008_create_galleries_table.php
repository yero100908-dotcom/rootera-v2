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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('residential'); // residential, commercial_b2b, tools_equipment, team_action, before_after
            $table->enum('media_type', ['image', 'video'])->default('image');
            $table->string('thumbnail_path');
            $table->string('media_file_path')->nullable();
            $table->string('external_media_url')->nullable();
            $table->string('before_image_path')->nullable();
            $table->string('location_tag')->nullable();
            $table->string('related_service_url')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
