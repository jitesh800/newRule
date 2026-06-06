<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rule_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_rule_id')->constrained('price_rules')->cascadeOnDelete();
            $table->string('target_type', 100);
            $table->unsignedBigInteger('target_id');
            $table->timestamps();
            $table->index(['target_type','target_id'], 'idx_target_lookup');
            $table->index('price_rule_id', 'idx_rule_target');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rule_targets');
    }
};
