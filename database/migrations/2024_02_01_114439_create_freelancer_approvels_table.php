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
        Schema::create('freelancer_approvels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('user_id=user table id for freelancer');
            $table->string('training_category_id')->constrained('training_categories')->comment('training_category_id=training_categories table id');
            $table->unsignedInteger('counselling')->default(1)->comment('counselling=1 for yes, 0 for no');
            $table->unsignedInteger('interview')->default(1)->comment('interview=1 for yes, 0 for no');
            $table->dateTime('meeting_date')->nullable();
            $table->foreignId('training_category_id')->constrained('training_categories');
            $table->text('remarks')->nullable();
            $table->foreignId('approve_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_approvels');
    }
};
