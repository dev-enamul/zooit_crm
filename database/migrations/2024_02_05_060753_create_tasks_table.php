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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('assign_to')->constrained('users');
            $table->foreignId('assign_by')->constrained('users');
            $table->date('date');
            $table->dateTime('submit_time')->nullable(); 
            $table->unsignedInteger('status')->default(0)->comment('0=pending, 1=completed'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
