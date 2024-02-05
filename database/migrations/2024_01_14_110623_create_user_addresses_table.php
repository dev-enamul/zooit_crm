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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->foreignId('division_id')->constrained()->nullable();
            $table->foreignId('district_id')->constrained()->nullable();
            $table->foreignId('upazila_id')->constrained()->nullable();
            $table->foreignId('union_id')->constrained()->nullable();
            $table->foreignId('village_id')->constrained()->nullable();
            $table->string('address', 250)->nullable(); 
            $table->foreignId('country_id')->constrained()->nullable();

            $table->foreignId('zone_id')->constrained()->nullable();
            $table->foreignId('area_id')->constrained()->nullable();
             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
