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
        Schema::create('field_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assign_to')->constrained('users');
            $table->foreignId('assign_by')->constrained('users');
            $table->date('month');
            $table->time('submit_time');
            $table->integer('freelancer')->default(0);
            $table->integer('customer')->default(0);
            $table->integer('prospecting')->default(0);
            $table->integer('cold_calling')->default(0);
            $table->integer('lead')->default(0);
            $table->integer('lead_analysis')->default(0);
            $table->integer('project_visit')->default(0);
            $table->integer('project_visit_analysis')->default(0);
            $table->integer('follow_up')->default(0);
            $table->integer('follow_up_analysis')->default(0);
            $table->integer('negotiation')->default(0);
            $table->integer('negotiation_analysis')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_targets');
    }
};
