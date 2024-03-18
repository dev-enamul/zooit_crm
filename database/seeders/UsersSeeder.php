<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Freelancer;
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
                'religion' => 1,
                'blood_group' => 1,
                'gender' => 1, 
                'created_by' => 1, 
                'updated_by' => 1,
            ],
            // [
            //     'user_id' => "EMP-002",
            //     'name' => "General Manager",
            //     'phone' => "01700000001",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-003",
            //     'name' => "Deputy General Manager",
            //     'phone' => "01700000002",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1,
                
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-004",
            //     'name' => "Assistant General Manager",
            //     'phone' => "01700000003",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1,
                
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-005",
            //     'name' => "Sales Manager",
            //     'phone' => "01700000004",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1,
                
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-006",
            //     'name' => "religional Manager",
            //     'phone' => "01700000005",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1,
                
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-007",
            //     'name' => "Zonal Co-Ordinator",
            //     'phone' => "01700000006",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1,
                
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ]
            // ,[
            //     'user_id' => "EMP-008",
            //     'name' => "Senior Zonal Manager",
            //     'phone' => "01700000007",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1,
                
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-009",
            //     'name' => "Zonal Manager",
            //     'phone' => "01700000008",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1,
                
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ]
            // ,[
            //     'user_id' => "EMP-010",
            //     'name' => "Asst. Zonal Manager",
            //     'phone' => "01700000009",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1,
                
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ]
            // ,[
            //     'user_id' => "EMP-011",
            //     'name' => "Area Incharge",
            //     'phone' => "01700000010",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ]
            // ,[
            //     'user_id' => "EMP-012",
            //     'name' => "DSM",
            //     'phone' => "01700000011",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ]
            // ,[
            //     'user_id' => "EMP-013",
            //     'name' => "ASM",
            //     'phone' => "01700000012",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-014",
            //     'name' => "Sr. Executive",
            //     'phone' => "01700000013",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-015",
            //     'name' => "Sales Executive",
            //     'phone' => "01700000014",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-016",
            //     'name' => "Junior Executive",
            //     'phone' => "01700000015",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "EMP-017",
            //     'name' => "Excutive Marketing",
            //     'phone' => "01700000016",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 1,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "FL-001",
            //     'name' => "Ex.Co-Ordinator",
            //     'phone' => "01700000017",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 2,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "FL-002",
            //     'name' => "Co Ordinator",
            //     'phone' => "01700000018",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 2,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "FL-003",
            //     'name' => "Co-Ordinator Applicant",
            //     'phone' => "01700000019",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 2,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[
            //     'user_id' => "FL-004",
            //     'name' => "Franchise Partner",
            //     'phone' => "01700000020",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 2,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[ 
            //     'user_id' => null,
            //     'name' => "Customer 1",
            //     'phone' => "01700000021",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 3,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ],[ 
            //     'user_id' => null,
            //     'name' => "Customer 2",
            //     'phone' => "01700000022",
            //     'password' => bcrypt('123456'),
            //     'user_type' => 3,
            //     'profile_image' => "",
            //     'marital_status' => 1, 
            //     'finger_id' => "43435343",
            //     'religion' => 1,
            //     'blood_group' => 1,
            //     'gender' => 1, 
            //     'created_by' => 1, 
            //     'updated_by' => 1,
            // ]
        ];
        DB::table('users')->insert($data); 
 

        // Employee  
        for($i=1; $i<=1; $i++){
            Employee::create([
                'user_id' => $i,
                'designation_id' => $i,
                'status' => 1,
            ]); 
        } 
        
        // Freelancer 
        // for($i=1; $i<=4; $i++){
        //     Freelancer::create([
        //         'user_id' => $i+17,
        //         'profession_id' => $i,
        //         'designation_id' => $i+17,
        //         'last_approve_by' => 1,
        //         'status' => 1,
        //     ]);
        // } 

        // for($i=1; $i<=2; $i++){
        //     Customer::create([
        //         'user_id' => $i+21,
        //         'customer_id' => 'CUS-0'.$i,
        //         'profession_id' => $i,
        //         'name' => 'Mehedi & Jamil',
        //         'ref_id' => $i+17, 
        //         'status' => 1,
        //     ]);
        // } 

        // for($i=1; $i<=2; $i++){
        //     Customer::create([
        //         'user_id' => $i+21,
        //         'customer_id' => 'CUS-0'.$i+2,
        //         'profession_id' => $i+2,
        //         'name' => 'Akash & Batas',
        //         'ref_id' => $i+19, 
        //         'status' => 1,
        //     ]);
        // }
        
    }
}
