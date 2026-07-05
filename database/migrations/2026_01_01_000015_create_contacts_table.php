<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('service_type')->nullable();
            $table->string('area')->nullable();
            $table->text('message');
            $table->enum('status', ['new', 'in_progress', 'completed', 'cancelled'])->default('new');
            $table->text('admin_notes')->nullable();
            $table->decimal('invoice_amount', 10, 2)->nullable(); // for revenue tracking
            $table->timestamp('completed_at')->nullable();
            $table->string('source')->default('website'); // website, whatsapp, phone
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
