<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residential_clusters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('district_id')->nullable()->constrained('districts')->nullOnDelete();
            $table->string('name');
            $table->string('slug', 120)->unique();
            $table->string('short_name')->nullable();
            $table->enum('tier', ['elite', 'premium', 'mid'])->default('premium');
            $table->string('developer')->nullable();
            $table->unsignedSmallInteger('built_year')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->json('landmarks')->nullable();
            $table->json('typical_issues')->nullable();
            $table->json('sub_clusters')->nullable();
            $table->string('property_profile')->nullable();
            $table->string('estimated_arrival')->default('30-45 Menit');
            $table->text('intro_override')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 320)->nullable();
            $table->unsignedSmallInteger('content_score')->default(0);
            $table->boolean('is_indexable')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['city_id', 'is_active', 'is_indexable'], 'clusters_city_active_indexable_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residential_clusters');
    }
};
