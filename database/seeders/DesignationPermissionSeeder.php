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
        foreach ($permissions as $permission){
            DesignationPermission::create([
                'designation_id'=> 1, 
                'permission_id' => $permission->id
            ]);
        }  
    }
}
