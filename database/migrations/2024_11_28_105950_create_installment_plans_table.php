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
        Schema::create('installment_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();  
            $table->foreignId('project_id')->index();  
            $table->date('payment_date');
            $table->decimal('amount', 10, 2);  
            $table->unsignedInteger('payment_status')
                  ->default(0)  
                  ->comment('0=Unpaid, 1=Paid');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installment_plans');
    }
};
