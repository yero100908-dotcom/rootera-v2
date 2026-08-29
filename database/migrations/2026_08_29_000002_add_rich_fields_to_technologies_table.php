<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('description');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->text('safety_guarantee_text')->nullable()->after('meta_description');
            $table->json('ideal_use_cases')->nullable()->after('safety_guarantee_text');
            $table->json('spec_sheet')->nullable()->after('ideal_use_cases');
            $table->json('faqs')->nullable()->after('spec_sheet');
        });
    }

    public function down(): void
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title',
                'meta_description',
                'safety_guarantee_text',
                'ideal_use_cases',
                'spec_sheet',
                'faqs',
            ]);
        });
    }
};
