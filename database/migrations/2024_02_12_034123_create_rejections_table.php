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
        Schema::create('rejections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->text('remark')->nullable();
            $table->foreignId('employee_id')->constrained('users');
            $table->foreignId('reject_reason_id')->constrained('reject_reasons');   
            
            $table->decimal('customer_price_capability', 10, 2)->nullable(); // If reason is high price
            $table->date('possible_purchase_date')->nullable(); // If reason is late buy
            $table->text('competitor_information')->nullable(); // If reason is Preference for Competitor  

            $table->foreignId('approve_by')->nullable()->constrained('users'); 
            $table->tinyInteger('status')->default(1)->comment('0= Active, 1= Inactive');
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
        Schema::dropIfExists('rejections');
    }
};
