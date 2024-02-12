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
        Schema::create('lead_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained(); 
            $table->foreignId('project_id')->nullable()->constrained('projects'); 
            $table->foreignId('unit_id')->nullable()->constrained('units');     
            $table->string('hobby')->nullable();
            $table->decimal('income_range', 10, 2)->nullable();
            $table->string('religion')->nullable();
            $table->integer('profession_year')->nullable();
            $table->string('customer_need')->nullable();
            $table->decimal('tentative_amount', 10, 2)->nullable();
            $table->string('facebook_id')->nullable();
            $table->text('customer_problem')->nullable();
            $table->string('referral')->nullable();
            $table->string('influencer')->nullable();
            $table->integer('family_member')->nullable();
            $table->string('decision_maker')->nullable();
            $table->string('previous_experience')->nullable();
            $table->string('instant_investment')->nullable();
            $table->string('buyer')->nullable();
            $table->string('area')->nullable();
            $table->string('consumer')->nullable();
        
            $table->foreignId('employee_id')->constrained('users'); 
            $table->foreignId('approve_by')->nullable()->constrained('users');  

            $table->tinyInteger('status')->default(1)->comment('1= Active, 0= Inactive');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_analyses');
    }
};
