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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('division_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();
            $table->foreignId('upazila_id')->nullable()->constrained();
            $table->foreignId('union_id')->nullable()->constrained();
            $table->foreignId('village_id')->nullable()->constrained();
            $table->string('address', 250)->nullable(); 
            $table->foreignId('country_id')->nullable()->constrained();
            $table->string('change_reason_document')->nullable();

            $table->foreignId('zone_id')->nullable()->constrained();
            $table->foreignId('area_id')->nullable()->constrained();
             
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
