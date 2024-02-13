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
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('commission_id')->constrainted('commissions');
            $table->date('date'); 
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
