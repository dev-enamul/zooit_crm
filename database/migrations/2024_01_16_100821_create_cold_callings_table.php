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
        Schema::create('cold_callings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();  
            $table->tinyInteger('priority')->nullable()->comment('1= High, 2= Regular, 3= Low');
            $table->string('remark')->nullable();  
            $table->foreignId('employee_id')->constrained('users');
            $table->date('lead_date')->nullable();
            
            $table->foreignId('approve_by')->nullable()->constrained('users');  
            $table->tinyInteger('status')->default(1)->comment('1= Complete, 0= Uncomplete');
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
        Schema::dropIfExists('cold_callings');
    }
};
