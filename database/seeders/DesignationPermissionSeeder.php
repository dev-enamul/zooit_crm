<?php

namespace Database\Seeders;

use App\Models\DesignationPermission;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationPermissionSeeder extends Seeder
{
   
    public function run(): void
    {
        $permissions = Permission::all();

        // Area Incharge to ASM Permission 
        $permissionIds = [
            9, 10, 12, 13, 15, 16, 18, 19, 21, 22,
            24, 25, 27, 28, 30, 31, 33, 34, 36, 37,
            39, 40, 42, 43, 45, 46, 48, 49, 51, 52,
            54, 55, 57, 58, 61, 62, 63, 64, 65, 66,
            67, 68, 69, 70, 71, 72, 73, 74, 75, 77,
            78, 79, 80, 81, 82, 83, 84, 85, 86, 87,
            88, 89, 90, 91, 92, 93, 95, 98, 102, 109,
            110, 111, 112, 113, 114, 115
        ];

        for($i=10; $i>=5;$i--){
            foreach ($permissionIds as $id){
                DesignationPermission::create([
                    'designation_id'=> $i, 
                    'permission_id' => $id
                ]);
            }
        }


        // permission for 	Incharge Sales to 	DSM
        $permissionIds = [
            9, 10, 12, 13, 15, 16, 18, 19, 21, 22,
            24, 25, 27, 28, 30, 31, 33, 34, 36, 37,
            39, 40, 42, 43, 45, 46, 48, 49, 51, 52,
            54, 55, 57, 58, 61, 62, 63, 64, 65, 66,
            67, 68, 70, 71, 73, 74, 77, 78, 79, 80,
            81, 82, 83, 84, 85, 86, 89, 95, 98, 109,
            110, 111, 112, 113, 114, 115
        ];

        for($i=10; $i>=5;$i--){
            foreach ($permissionIds as $id){
                DesignationPermission::create([
                    'designation_id'=> $i, 
                    'permission_id' =>$id
                ]);
            }
        }
         

        //permission for 	D.G.M  to MD
        for($i=4; $i>=1;$i--){
            foreach ($permissions as $permission){
                DesignationPermission::create([
                    'designation_id'=> $i, 
                    'permission_id' => $permission->id
                ]);
            }  
        } 
       
    }
}
