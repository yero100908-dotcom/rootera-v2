<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->default('❓');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('faqs', function (Blueprint $table) {
            if (!Schema::hasColumn('faqs', 'faq_category_id')) {
                $table->foreignId('faq_category_id')->nullable()->after('id')->constrained('faq_categories')->nullOnDelete();
            }
            if (!Schema::hasColumn('faqs', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('question');
            }
            if (!Schema::hasColumn('faqs', 'is_featured_home')) {
                $table->boolean('is_featured_home')->default(false)->after('answer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            if (Schema::hasColumn('faqs', 'faq_category_id')) {
                $table->dropForeign(['faq_category_id']);
                $table->dropColumn('faq_category_id');
            }
            if (Schema::hasColumn('faqs', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('faqs', 'is_featured_home')) {
                $table->dropColumn('is_featured_home');
            }
        });

        Schema::dropIfExists('faq_categories');
    }
};
