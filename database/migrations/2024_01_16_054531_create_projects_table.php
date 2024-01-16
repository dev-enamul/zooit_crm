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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('total_floor')->nullable();
            $table->string('google_map')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable(); 
            $table->foreignId('countrie_id')->constrained()->nullable();
            $table->foreignId('division_id')->constrained()->nullable();
            $table->foreignId('district_id')->constrained()->nullable();
            $table->foreignId('upazila_id')->constrained()->nullable();
            $table->foreignId('village_id')->constrained()->nullable();
            $table->foreignId('union_id')->constrained()->nullable();
             

            $table->tinyInteger('status')->default(1)->comment('1= Active, 0= Inactive');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
