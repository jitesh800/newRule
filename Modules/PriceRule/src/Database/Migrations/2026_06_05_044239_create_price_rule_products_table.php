<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rule_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_rule_id')->constrained('price_rules')->cascadeOnDelete();
            // $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->unsignedBigInteger('product_id');
            $table->decimal('override_discount_value', 12, 4)->nullable();
            $table->timestamps();
            $table->unique(['price_rule_id', 'product_id'],'uq_rule_product');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rule_products');
    }
};
