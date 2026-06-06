<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rule_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_rule_id')->constrained('price_rules')->cascadeOnDelete();
            $table->string('field', 100);
            $table->enum('operator', ['=','!=','>','>=','<','<=','in','not_in','between','contains']);
            $table->json('value');
            $table->unsignedSmallInteger('sort_order')->default(1);
            $table->timestamps();
            $table->index(['price_rule_id','field'], 'idx_rule_field');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rule_conditions');
    }
};
