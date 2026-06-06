<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rule_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_rule_id')->constrained('price_rules')->cascadeOnDelete();
            $table->string('action_type', 100);
            $table->json('configuration');
            $table->unsignedSmallInteger('sort_order')->default(1);
            $table->timestamps();
            $table->index(['price_rule_id','action_type'], 'idx_rule_action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rule_actions');
    }
};
