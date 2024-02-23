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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable()->unique();  
            $table->string('name');
            $table->string('phone', 15)->unique();
            $table->string('password');
            $table->tinyInteger('user_type')->nullable()->comment('1= Employee, 2= Freelancer, 3= Customer');
            $table->string('profile_image')->nullable();
            $table->tinyInteger('marital_status')->nullable()->comment('1= Married, 2= Unmarried, 3 = Divorce');
            $table->date('dob')->nullable();
            $table->string('finger_id')->nullable();
            $table->tinyInteger('religion')->nullable()->comment('1 = Islam, 2 = Christianity, 3 = Hinduism, 4 = Buddhism, 5 = Judaism, 6 = Sikhism, 7 = Jainism, 8 = Baháulláh, 9 = Confucianism, 10 = Others');
            $table->tinyInteger('blood_group')->nullable()->comment('1 = A+, 2 = A-, 3 = B+, 4 = B-, 5 = AB+, 6 = AB-, 7 = O+, 8 = O-');
            $table->tinyInteger('gender')->nullable()->comment('1= "Male" 2= "Female", 3= "Others"');
            $table->tinyInteger('nationality')->nullable()->comment('1= Bangladeshi, 0= Indian');
            

            $table->foreignId('approve_by')->nullable()->constrained('users'); 
            $table->foreignId('ref_id')->nullable()->constrained('users'); 

            $table->tinyInteger('status')->default(1)->comment('1= Active, 0= Inactive');
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
