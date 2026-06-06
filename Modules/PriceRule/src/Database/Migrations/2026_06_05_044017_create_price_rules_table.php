<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rule_type_id')->constrained('price_rule_types')->restrictOnDelete();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->text('description')->nullable();
            // $table->enum('status', ['draft','scheduled','active','expired'])->default('draft');
            $table->string('status', 30)->default('draft');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->unsignedSmallInteger('priority')->default(100);
            $table->boolean('stop_further_rules')->default(false);
            $table->boolean('is_combinable')->default(true);
            $table->boolean('coupon_required')->default(false);
            $table->enum('condition_match', ['all','any'])->default('all');
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status','priority','starts_at','ends_at'], 'idx_rule_active_priority');
            $table->index(['rule_type_id','status'], 'idx_rule_type_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_rules');
    }
};
