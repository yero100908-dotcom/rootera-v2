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
        Schema::table('project_galleries', function (Blueprint $table) {
            $table->string('tool_used')->nullable()->after('client_type');
            $table->string('pipe_specs')->nullable()->after('tool_used');
            $table->string('pipe_length')->nullable()->after('pipe_specs');
            $table->integer('warranty_days')->default(30)->after('completion_time');
            $table->decimal('cost_estimate', 12, 2)->nullable()->after('warranty_days');
            $table->text('technical_diagnosis')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_galleries', function (Blueprint $table) {
            $table->dropColumn([
                'tool_used',
                'pipe_specs',
                'pipe_length',
                'warranty_days',
                'cost_estimate',
                'technical_diagnosis',
            ]);
        });
    }
};
