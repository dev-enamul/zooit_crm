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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->string('name')->nullable();
            $table->foreignId('ref_id')->nullable()->constrained('users');
            $table->foreignId('project_id')->nullable()->constrained('projects');
            $table->foreignId('sub_project_id')->nullable()->constrained('sub_projects'); 
            $table->foreignId('find_media_id')->nullable()->constrained('find_media');
            $table->tinyInteger('type')->default(1)->comment('1=Person, 2 = Company'); 

            $table->date('company_dob')->nullable()->comment('if type is company');
            $table->string('last_stpe')->nullable()->comment('1=Customer, 2= Prospecting, 3= Cold Calling, 4 =Lead, 5 = Presentation, 6= Followup, 7 = Negotiation 8= Rejection 9 = Sales');
            $table->integer('purchase_possibility')->default(0)->comment("Min: 0, Max: 100");

            $table->foreignId('approve_by')->nullable()->constrained('users');  
            $table->tinyInteger('status')->default(1)->comment('1= Complete, 0= Uncomplete');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->softDeletes();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
