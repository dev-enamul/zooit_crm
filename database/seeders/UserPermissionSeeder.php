<?php

namespace Database\Seeders;

use App\Models\Permission;
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
        $permissions = Permission::all();
        foreach($permissions as $permission){
            UserPermission::create([
                'user_id' => 1,
                'permission_id' => $permission->id
            ]);
        }
    }
}
