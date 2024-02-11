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
        Schema::create('deposit_target_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deposit_target_id')->constrained('deposit_targets');
            $table->foreignId('project_id')->constrained('projects'); 
            $table->integer('new_unit')->default(0);
            $table->float('new_deposit', 10, 2)->default(0);
            $table->integer('existing_unit')->default(0);
            $table->float('existing_deposit', 10, 2)->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_target_projects');
    }
};
