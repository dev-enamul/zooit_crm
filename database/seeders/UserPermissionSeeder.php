<?php

namespace Database\Seeders;

use App\Models\DesignationPermission;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = UserPermission::all();
        dd($data);
        // $permissions = Permission::all(); 
        // foreach($permissions as $permission){
        //     UserPermission::create([
        //         'user_id' => 1,
        //         'permission_id' => $permission->id
        //     ]);
        // } 

        UserPermission::truncate();
        $users = User::where('user_type','1')->get();
      
        foreach($users as $user){ 
            if(isset($user->employee->designation_id) && !empty($user->employee->designation_id)){
                $designation_permissions = DesignationPermission::where('designation_id', $user->employee->designation_id)->select('permission_id')->get();
                foreach($designation_permissions as $designation_permission){
                    UserPermission::create([
                        'user_id' => $user->id,
                        'permission_id' => $designation_permission->permission_id
                    ]);
                }
            }
            
        }
        
    }
}
