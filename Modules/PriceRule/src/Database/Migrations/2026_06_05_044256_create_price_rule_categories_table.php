<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rule_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_rule_id')->constrained('price_rules')->cascadeOnDelete();
            $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->boolean('include_subcategories')->default(true);
            $table->timestamps();
            $table->unique(['price_rule_id', 'category_id'],'uq_rule_category');
            $table->index('category_id','idx_category_rules');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rule_categories');
    }
};
