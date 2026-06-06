<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rule_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_rule_id')->constrained('price_rules')->cascadeOnDelete();
            $table->enum('recurrence_type', ['daily','weekly','monthly','custom'])->default('weekly');
            $table->unsignedTinyInteger('day_of_week')->nullable();
            $table->unsignedTinyInteger('day_of_month')->nullable();
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
            $table->string('timezone', 50)->default('Asia/Kolkata');
            $table->timestamps();
            $table->index(['price_rule_id','recurrence_type'], 'idx_schedule_rule');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rule_schedules');
    }
};
