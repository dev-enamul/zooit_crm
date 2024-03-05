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
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('designation_id')->constrainted('designations');
            $table->foreignId('salse_id')->constrained('salses');
            $table->foreignId('deposit_id')->constrained('deposits'); 
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('commission_id')->constrained('commissions'); 
            $table->integer('commission_percent');
            $table->decimal('amount', 10, 2);
            $table->decimal('applicable_commission',10, 2);
            $table->decimal('payble_commission',10, 2);
            $table->foreignId('created_by')->constrained('users');
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
