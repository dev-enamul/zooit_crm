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
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->tinyInteger('type')->default(1)->comment('1=Person, 2 = Company');
            $table->foreignId('designation_id')->nullable()->constrained('designations');
            $table->string('name')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('religion')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('personal_phone', 15)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('personal_email', 45)->nullable();
            $table->string('imo_number', 15)->nullable();
            $table->string('facebook_id', 100)->nullable(); 
            $table->string('linkedin_id', 100)->nullable(); 
            $table->string('twiter_id', 100)->nullable(); 
            $table->string('instragram_id', 100)->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_contacts');
    }
};
