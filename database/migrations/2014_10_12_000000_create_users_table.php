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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable()->unique();  
            $table->string('name');
            $table->string('phone', 25)->unique();
            $table->string('password');
            $table->tinyInteger('user_type')->nullable()->comment('1= Employee, 2= Freelancer, 3= Customer');
            $table->string('profile_image')->nullable();  

            $table->foreignId('approve_by')->nullable()->constrained('users');
            $table->foreignId('ref_id')->nullable()->constrained('users'); 
            $table->tinyInteger('status')->default(1)->comment('1= Active, 0= Inactive');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
