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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->string('name'); // e.g. "Jakarta Selatan", "Bandung", "Semarang"
            $table->string('type')->default('Kota'); // "Kota" or "Kabupaten"
            $table->string('slug')->unique();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->default('6281385404000');
            $table->string('estimated_arrival')->default('30-45 Menit');
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('cities');
    }
};
