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
            $table->foreignId('profession_id')->nullable()->constrained('professions');
            $table->foreignId('designation_id')->nullable()->constrained('designations');

            $table->string('change_reason_document')->nullable();
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

// ref_id = employee_id
// created_by = auth:id 
// status = complete or uncomplete  //when status will 1 user will get freelancer_id and can training
// last_approve_by = employee_id

// User table
// approve_by = final approve by 
// status = active or inactive  // when status will 1 can work
// ref_id = Employee id


