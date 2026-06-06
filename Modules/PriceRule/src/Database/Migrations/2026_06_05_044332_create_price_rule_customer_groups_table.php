<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rule_customer_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_rule_id')->constrained('price_rules')->cascadeOnDelete();
            $table->unsignedBigInteger('customer_group_id');
            $table->timestamps();
            $table->unique(['price_rule_id', 'customer_group_id'], 'uq_rule_custgroup');
            $table->index('customer_group_id', 'idx_custgroup_rules');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rule_customer_groups');
    }
};
