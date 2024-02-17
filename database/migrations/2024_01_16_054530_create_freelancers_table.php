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
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); 
            $table->foreignId('profession_id')->constrained('professions')->nullable();
            $table->foreignId('designation_id')->constrained('designations')->nullable();

            $table->foreignId('last_approve_by')->constrained('users');
            $table->foreignId('ref_id')->nullable()->constrained('users'); 
            $table->tinyInteger('status')->default(1)->comment('1= Complete, 0= Pending');
            $table->softDeletes();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancers');
    }
};
