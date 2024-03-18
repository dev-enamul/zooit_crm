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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('profession_id')->nullable()->constrained();
            $table->string('name')->nullable(); 
            $table->unsignedBigInteger('ref_id')->nullable();
            $table->foreign('ref_id')->references('id')->on('users');

            $table->foreignId('approve_by')->nullable()->constrained('users'); 

            $table->tinyInteger('status')->default(1)->comment('1= Complete, 0= Uncomplete');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->softDeletes();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
