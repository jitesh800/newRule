<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rule_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_rule_id')->constrained('price_rules')->cascadeOnDelete();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->decimal('discount_amount', 12, 4);
            $table->decimal('order_subtotal', 12, 4);
            $table->string('currency', 3)->default('INR');
            $table->timestamps();
            $table->index(['price_rule_id','customer_id'], 'idx_usage_rule_customer');
            $table->index('order_id', 'idx_usage_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rule_usages');
    }
};
