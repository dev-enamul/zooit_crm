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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();  
            $table->tinyInteger('purchase_capacity')->nullable()->comment('1= High, 2= Regular, 3= Low'); 
            $table->foreignId('project_id')->nullable()->constrained('projects'); 
            $table->foreignId('unit_id')->nullable()->constrained('units'); 
            $table->date('possible_purchase_date')->nullable();
            $table->string('remark')->nullable();  
            $table->foreignId('employee_id')->constrained('users'); 
            $table->foreignId('approve_by')->nullable()->constrained('users');  

            $table->tinyInteger('status')->default(1)->comment('1= Active, 0= Inactive');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
