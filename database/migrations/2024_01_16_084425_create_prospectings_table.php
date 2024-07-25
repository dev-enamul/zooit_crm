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
        Schema::create('prospectings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('media')->nullable()->comment('1= Phone, 2= Meet'); 
            $table->string('remark')->nullable(); 
            $table->foreignId('customer_id')->constrained('customers');
            $table->date('cold_call_date')->nullable(); 
            $table->integer('purchase_possibility')->comment('0-100');
            $table->foreignId('user_contact_id')->nullable()->constrained('user_contacts')->comment('contact person id');
            $table->text('customer_opinion')->nullable();
            
            $table->foreignId('employee_id')->constrained('users'); 
            $table->unsignedBigInteger('approve_by')->nullable();
            $table->foreign('approve_by')->references('id')->on('users'); 
            
            $table->tinyInteger('status')->default(1)->comment('1= Complete, 0= UnComplete');
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
        Schema::dropIfExists('prospectings');
    }
};
