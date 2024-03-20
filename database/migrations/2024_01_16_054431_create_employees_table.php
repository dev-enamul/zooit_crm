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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained();
            $table->foreignId('designation_id')->nullable()->constrained(); // designation wise commission
            $table->json('designations')->nullable(); // just for show in profile

            $table->string('change_reason_document')->nullable();
            $table->float('serial', 8, 2)->nullable();
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
        Schema::dropIfExists('employees');
    }
};
