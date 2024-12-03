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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade'); 
            $table->decimal('amount', 15, 2); 
            $table->date('date'); 
            $table->foreignId('bank_id')->constrained()->onDelete('cascade'); 
            $table->string('tnx_id')->nullable(); 
            $table->text('remark')->nullable();
            $table->string('document')->nullable()->comment('image of bank'); 
            $table->integer('status')->default(1)->comment('0= Unapproved, 1= Approved');
            $table->timestamps();
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
