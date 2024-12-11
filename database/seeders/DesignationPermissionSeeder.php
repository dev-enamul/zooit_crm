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
        DesignationPermission::truncate();
        $permissions = Permission::all();
 
        //permission for 	D.G.M  to MD
        for($i=1; $i>=1;$i--){
            foreach ($permissions as $permission){
                DesignationPermission::create([
                    'designation_id'=> $i, 
                    'permission_id' => $permission->id
                ]);
            }  
        } 
       
    }
}
