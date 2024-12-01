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
            $table->foreignId('customer_id')->index()->constrained();
            $table->foreignId('project_id')->index();
            $table->date('payment_date');
            $table->decimal('amount', 10, 2);
            $table->unsignedInteger('is_invoiced')
                  ->default(0)  
                  ->comment('0=no, 1=yes');  
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
