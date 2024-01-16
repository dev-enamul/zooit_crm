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
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('bank_id')->constrained()->nullable();
            $table->string('branch')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_details')->nullable();
            $table->unsignedBigInteger('mobile_bank_id')->nullable();  
            $table->foreign('mobile_bank_id')->references('id')->on('banks')->onDelete('set null')->onUpdate('cascade');
            $table->string('mobile_bank_account_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_transactions');
    }
};
