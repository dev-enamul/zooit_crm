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
            $table->foreignId('ref_id')->nullable()->constrained('users');
            $table->foreignId('project_id')->nullable()->constrained('projects');
            $table->foreignId('sub_project_id')->nullable()->constrained('sub_projects');
            $table->integer('purchase_posibility')->default(0)->comment("Min: 0, Max: 100");
            $table->foreignId('find_media_id')->nullable()->constrained('find_media');
            $table->tinyInteger('type')->default(1)->comment('1=Person, 2 = Company');

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
