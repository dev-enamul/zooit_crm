<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ 
    public function up(): void
    {
        Schema::create('deposit_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deposit_id')->constrained('deposits');
            $table->foreignId('user_id')->constrainted('users');
            $table->foreignId('designation_id')->constrainted('designations');
            $table->foreignId('project_id')->nullable()->constrained('projects');
            $table->foreignId('commission_id')->constrainted('commissions');
            $table->integer('commission_percent');
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->date('date')->default(now()); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_commissions');
    }
};
