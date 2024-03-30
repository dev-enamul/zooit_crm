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
            $table->decimal('commission_percent', 10, 2);
            $table->json('share_ids')->nullable();
            $table->decimal('amount', 10, 2);
            $table->decimal('applicable_commission',10, 2)->default(0);
            $table->decimal('payble_commission',10, 2)->default(0);
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
