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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('customer_user_id')->constrained('users');
            $table->foreignId('deposit_category_id')->nullable()->constrained('deposit_categories')->comment('Null = Regular');
            $table->foreignId('project_id')->nullable()->constrained('projects');
            $table->foreignId('salse_id')->nullable()->constrained('salses');
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->foreignId('bank_id')->constrained('banks');
            $table->string('cheque_no')->nullable();
            $table->string('branch_name')->nullable();
            $table->text('remark')->nullable(); 
   
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
        Schema::dropIfExists('deposits');
    }
};
