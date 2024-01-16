<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        DB::table('users')->delete();

        $data = [
            [
                'user_id' => "EMP-001",
                'name' => "Employee 1",
                'phone' => "01796351081",
                'password' => bcrypt('123456'),
                'user_type' => 1,
                'profile_image' => "",
                'marital_status' => 1,
                
                'finger_id' => "43435343",
                'region' => 1,
                'blood_group' => 1,
                'gender' => 1, 
                'created_by' => 1, 
                'updated_by' => 1,
            ],[
                'user_id' => "EMP-002",
                'name' => "Employee 2",
                'phone' => "01796351082",
                'password' => bcrypt('123456'),
                'user_type' => 1,
                'profile_image' => "",
                'marital_status' => 1,
                
                'finger_id' => "43435343",
                'region' => 1,
                'blood_group' => 1,
                'gender' => 1, 
                'created_by' => 1, 
                'updated_by' => 1,
            ],[
                'user_id' => "EMP-003",
                'name' => "Employee 3",
                'phone' => "01796351083",
                'password' => bcrypt('123456'),
                'user_type' => 1,
                'profile_image' => "",
                'marital_status' => 1,
                
                'finger_id' => "43435343",
                'region' => 1,
                'blood_group' => 1,
                'gender' => 1, 
                'created_by' => 1, 
                'updated_by' => 1,
            ],[
                'user_id' => "EMP-004",
                'name' => "Employee 4",
                'phone' => "01796351084",
                'password' => bcrypt('123456'),
                'user_type' => 1,
                'profile_image' => "",
                'marital_status' => 1,
                
                'finger_id' => "43435343",
                'region' => 1,
                'blood_group' => 1,
                'gender' => 1, 
                'created_by' => 1, 
                'updated_by' => 1,
            ],[
                'user_id' => "EMP-005",
                'name' => "Employee 5",
                'phone' => "01796351085",
                'password' => bcrypt('123456'),
                'user_type' => 1,
                'profile_image' => "",
                'marital_status' => 1,
                
                'finger_id' => "43435343",
                'region' => 1,
                'blood_group' => 1,
                'gender' => 1, 
                'created_by' => 1, 
                'updated_by' => 1,
            ],[
                'user_id' => "FL-001",
                'name' => "Employee 6",
                'phone' => "01796351086",
                'password' => bcrypt('123456'),
                'user_type' => 1,
                'profile_image' => "",
                'marital_status' => 1,
                
                'finger_id' => "43435343",
                'region' => 1,
                'blood_group' => 1,
                'gender' => 1, 
                'created_by' => 1, 
                'updated_by' => 1,
            ],[
                'user_id' => "CUS-001",
                'name' => "Employee 6",
                'phone' => "01796351087",
                'password' => bcrypt('123456'),
                'user_type' => 1,
                'profile_image' => "",
                'marital_status' => 1,
                
                'finger_id' => "43435343",
                'region' => 1,
                'blood_group' => 1,
                'gender' => 1, 
                'created_by' => 1, 
                'updated_by' => 1,
            ]
        ];
        DB::table('users')->insert($data);
    }
}
