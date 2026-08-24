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
        Schema::create('project_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->nullable()->constrained('service_categories')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('cascade');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_type')->default('Rumah Tangga'); // Rumah, Restoran/Cafe, Ruko, Pabrik/Industri, Hotel/Apartemen, Instansi
            $table->string('before_image')->nullable();
            $table->string('after_image')->nullable();
            $table->text('description')->nullable();
            $table->string('completion_time')->default('1-2 Jam');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_galleries');
    }
};
