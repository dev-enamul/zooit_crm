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
        Schema::create('salse_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('customer_user_id')->constrained('users');
            $table->date('booking_date')->nullable();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->decimal('declaration_value', 10, 2)->nullable();
            $table->decimal('sold_value', 10, 2);
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->decimal('total_deposit', 10, 2)->nullable();
            $table->decimal('due', 10, 2)->nullable();
            $table->foreignId('unit_id')->nullable()->constrained();
            $table->string('unit_name')->nullable();
            $table->string('unit_facility')->nullable();
            $table->string('on_choice_floor_no')->nullable();
            $table->string('on_choice_unit_no')->nullable();
            $table->string('unit_type')->nullable();
            $table->string('lottery')->nullable();
            $table->string('total_installment')->nullable();
            $table->enum('negotiation_type', ['same_project', 'another_project'])->nullable();
            $table->decimal('deduction_amount', 10, 2)->nullable();
            $table->decimal('sales_return_amount', 10, 2)->nullable();
           
            $table->foreignId('employee_id')->constrained('users');  
            $table->foreignId('approve_by')->nullable()->constrained('users'); 
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salse_returns');
    }
};
