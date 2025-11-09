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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained();
            $table->foreignId('customer_id')->index()->constrained();
            $table->foreignId('project_id')->index();
            $table->string('reason'); 
            $table->tinyInteger('package_type')->comment('1 = Yearly, 2 = Monthly'); 
            $table->decimal('amount', 10, 2); 
            $table->date('next_payment_date');
            $table->string('payment_timing')->default('start'); //start == start of month or year, end= end of year of month
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
