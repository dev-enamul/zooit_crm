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
        Schema::create('project_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('floor');
            $table->string('description')->nullable();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('unit_category_id')->constrained();
            $table->foreignId('unit_id')->constrained(); 
            $table->decimal('lottery_price', 10, 2);
            $table->decimal('on_choice_price', 10, 2);


            $table->tinyInteger('status')->default(1)->comment('1= Active, 0= Inactive');
            $table->tinyInteger('sold_status')->default(0)->comment('0=Unsold, 1= Sold by On Choice, 1= Sold by On Lottery,  3 = Return');
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
        Schema::dropIfExists('project_units');
    }
};
