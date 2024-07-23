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
        Schema::create('advance_settings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_customer_company')->default(1)->comment("1= Customer is Company 0= Customer is Indivisul Person");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advance_settings');
    }
};
