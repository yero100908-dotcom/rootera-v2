<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->constrained('service_categories')->cascadeOnDelete();
            $table->string('keyword');
            $table->string('slug', 120)->unique();
            $table->enum('intent', ['transactional', 'problem', 'informational'])->default('transactional');
            $table->enum('usage', ['copy_only', 'landing_page'])->default('copy_only');
            $table->unsignedInteger('search_volume')->nullable();
            $table->text('intro_override')->nullable();
            $table->json('faq_overrides')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['service_category_id', 'keyword'], 'aliases_category_keyword_unique');
            $table->index(['service_category_id', 'is_active', 'usage'], 'aliases_category_active_usage_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_aliases');
    }
};
