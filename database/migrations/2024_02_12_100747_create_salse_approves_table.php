<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salse_approves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salse_id')->constrained('cold_callings');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('user_id')->constrained(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salse_approves');
    }
};
