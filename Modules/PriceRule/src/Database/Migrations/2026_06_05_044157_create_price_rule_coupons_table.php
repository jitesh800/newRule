<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rule_coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_rule_id')->constrained('price_rules')->cascadeOnDelete();
            $table->string('code', 100)->unique();
            $table->enum('type', ['shared','unique'])->default('shared');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('usage_limit')->nullable();
            $table->unsignedInteger('usage_count')->default(0);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['code','is_active'], 'idx_coupon_lookup');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rule_coupons');
    }
};
