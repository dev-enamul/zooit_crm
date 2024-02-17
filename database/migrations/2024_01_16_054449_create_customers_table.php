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
            $table->foreignId('profession_id')->constrained()->nullable();
            $table->string('name')->nullable(); 
            $table->unsignedBigInteger('ref_id')->nullable();
            $table->foreign('ref_id')->references('id')->on('users');
            $table->tinyInteger('status')->default(1)->comment('1= Active, 0= Inactive');
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
