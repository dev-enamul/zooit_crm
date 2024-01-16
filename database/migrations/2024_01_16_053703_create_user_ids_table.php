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
        Schema::create('user_ids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id'); 
            $table->string('nid_number')->nullable();
            $table->string('nid_image')->nullable();
            $table->string('birth_cirtificate_number')->nullable();
            $table->string('birth_cirtificate_image')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_image')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_exp_date')->nullable();
            $table->string('tin_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ids');
    }
};
