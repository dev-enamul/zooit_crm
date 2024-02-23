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
        Schema::create('salses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->uniqid(); 
            $table->foreignId('customer_user_id')->constrained('users');
            $table->foreignId('project_id')->constrained();  
            $table->foreignId('unit_id')->constrained();  
            $table->integer('payment_duration')->nullable()->comment('In Month');
            $table->unsignedInteger('select_type')->nullable()->comment('1= onChoice, 2= Lottery');
            $table->json('project_units')->nullable()->comment('Project Unit List');
            $table->decimal('regular_amount', 10, 2)->nullable()->comment('Total Amount');
            $table->decimal('sold_value', 10, 2); 
            $table->decimal('down_payment', 10, 2);
            $table->decimal('down_payment_pay', 10, 2);
            $table->date('rest_down_payment_date');
            $table->decimal('total_deposit', 10, 2);
            $table->enum('installment_type', ['weekly', 'bi-weekly', 'monthly', 'bi-monthly', 'quarterly', 'semi-annually', 'annually']);
            $table->decimal('installment_value', 10, 2);
            $table->string('facility');

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
        Schema::dropIfExists('salses');
    }
};
