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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();

            $table->tinyInteger('priority')->default(0)
                ->comment('0=low, 1=medium, 2=high, 3=urgent, 4=Fire Urgent');

            $table->integer('estimated_time')->nullable()->comment('in hours');
            $table->integer('time_spent')->nullable()->comment('in hours');

            $table->foreignId('assign_to')->nullable()->constrained('users', 'id');
            $table->foreignId('assign_by')->nullable()->constrained('users', 'id');

            $table->dateTime('submit_time')->nullable();

            $table->tinyInteger('status')->default(0)
                ->comment('0=pending, 1=completed, 2=in progress');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
