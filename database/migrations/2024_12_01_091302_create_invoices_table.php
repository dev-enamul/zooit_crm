<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->string('title')->nullable()->comment('Reason for invoice');
            $table->text('description')->nullable()->comment('Description');  
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->decimal('amount', 15, 2);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);
            $table->decimal('due_amount', 15, 2)->default(0);
            $table->integer('status')->default(0)->comment('0= Unpaid, 1= Paid, 2 = Parsial');   
            $table->timestamps(); 
        });
     
        DB::statement('ALTER TABLE invoices AUTO_INCREMENT = 2500;');
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
