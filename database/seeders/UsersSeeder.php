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
                'name' => "Super Admin",
                'phone' => "01700000000",
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
                'name' => "General Manager",
                'phone' => "01700000001",
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
                'name' => "Deputy General Manager",
                'phone' => "01700000002",
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
                'name' => "Assistant General Manager",
                'phone' => "01700000003",
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
                'name' => "Sales Manager",
                'phone' => "01700000004",
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
                'name' => "Regional Manager",
                'phone' => "01700000005",
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
