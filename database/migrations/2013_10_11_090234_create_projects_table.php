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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');  
            $table->foreignId('project_proposal_id')->nullable();  
            $table->foreignId('team_leader_id')->nullable();
            $table->foreignId('sales_by')->nullable();
         
            $table->decimal('price', 10, 2)->nullable(); 
            $table->decimal('paid', 10, 2)->nullable(); 
            $table->date('submit_date')->nullable();
            $table->unsignedInteger('project_status')
                  ->default(0)
                  ->comment('0=Running, 1=Complete');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('1=Active, 0=Inactive'); 
            $table->text('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
