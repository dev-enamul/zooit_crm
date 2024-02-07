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
        Schema::create('deposit_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assign_to')->constrained('users');
            $table->foreignId('assign_by')->constrained('users');
            $table->unsignedInteger('is_project_wise')->default(0)->comment('0=No, 1=Yes');
            $table->float('new_deposit', 10, 2)->nullable();
            $table->float('existing_deposit', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_targets');
    }
};
