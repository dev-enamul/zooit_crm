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
        Schema::create('unit_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_duration')->comment('Month wise');
            $table->string('on_choice_price');
            $table->string('lottery_price');
            $table->foreignId('project_unit_id')->constrained();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_prices');
    }
};
