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
        $data = [
            ['designation_id' => 10, 'permission_id' => 9],
            ['designation_id' => 10, 'permission_id' => 10],
            ['designation_id' => 10, 'permission_id' => 12],
            ['designation_id' => 10, 'permission_id' => 13],
            ['designation_id' => 10, 'permission_id' => 15],
            ['designation_id' => 10, 'permission_id' => 16],
            ['designation_id' => 10, 'permission_id' => 18],
            ['designation_id' => 10, 'permission_id' => 19],
            ['designation_id' => 10, 'permission_id' => 21],
            ['designation_id' => 10, 'permission_id' => 22],
            ['designation_id' => 10, 'permission_id' => 24],
            ['designation_id' => 10, 'permission_id' => 25],
            ['designation_id' => 10, 'permission_id' => 27],
            ['designation_id' => 10, 'permission_id' => 28],
            ['designation_id' => 10, 'permission_id' => 30],
            ['designation_id' => 10, 'permission_id' => 31],
            ['designation_id' => 10, 'permission_id' => 33],
            ['designation_id' => 10, 'permission_id' => 34],
            ['designation_id' => 10, 'permission_id' => 36],
            ['designation_id' => 10, 'permission_id' => 37],
            ['designation_id' => 10, 'permission_id' => 39],
            ['designation_id' => 10, 'permission_id' => 40],
            ['designation_id' => 10, 'permission_id' => 42],
            ['designation_id' => 10, 'permission_id' => 43],
            ['designation_id' => 10, 'permission_id' => 45],
            ['designation_id' => 10, 'permission_id' => 46],
            ['designation_id' => 10, 'permission_id' => 48],
            ['designation_id' => 10, 'permission_id' => 49],
            ['designation_id' => 10, 'permission_id' => 51],
            ['designation_id' => 10, 'permission_id' => 52],
            ['designation_id' => 10, 'permission_id' => 54],
            ['designation_id' => 10, 'permission_id' => 55],
            ['designation_id' => 10, 'permission_id' => 57],
            ['designation_id' => 10, 'permission_id' => 58],
            ['designation_id' => 10, 'permission_id' => 61],
            ['designation_id' => 10, 'permission_id' => 62],
            ['designation_id' => 10, 'permission_id' => 63],
            ['designation_id' => 10, 'permission_id' => 64],
            ['designation_id' => 10, 'permission_id' => 65],
            ['designation_id' => 10, 'permission_id' => 66],
            ['designation_id' => 10, 'permission_id' => 67],
            ['designation_id' => 10, 'permission_id' => 68],
            ['designation_id' => 10, 'permission_id' => 69],
            ['designation_id' => 10, 'permission_id' => 70],
            ['designation_id' => 10, 'permission_id' => 71],
            ['designation_id' => 10, 'permission_id' => 72],
            ['designation_id' => 10, 'permission_id' => 73],
            ['designation_id' => 10, 'permission_id' => 74],
            ['designation_id' => 10, 'permission_id' => 75],
            ['designation_id' => 10, 'permission_id' => 77],
            ['designation_id' => 10, 'permission_id' => 78],
            ['designation_id' => 10, 'permission_id' => 79],
            ['designation_id' => 10, 'permission_id' => 80],
            ['designation_id' => 10, 'permission_id' => 81],
            ['designation_id' => 10, 'permission_id' => 82],
            ['designation_id' => 10, 'permission_id' => 83],
            ['designation_id' => 10, 'permission_id' => 84],
            ['designation_id' => 10, 'permission_id' => 85],
            ['designation_id' => 10, 'permission_id' => 86],
            ['designation_id' => 10, 'permission_id' => 87],
            ['designation_id' => 10, 'permission_id' => 88],
            ['designation_id' => 10, 'permission_id' => 89],
            ['designation_id' => 10, 'permission_id' => 90],
            ['designation_id' => 10, 'permission_id' => 91],
            ['designation_id' => 10, 'permission_id' => 92],
            ['designation_id' => 10, 'permission_id' => 93],
            ['designation_id' => 10, 'permission_id' => 95],
            ['designation_id' => 10, 'permission_id' => 98],
            ['designation_id' => 10, 'permission_id' => 102],
            ['designation_id' => 10, 'permission_id'=> 109],
            ['designation_id' => 10, 'permission_id' => 110],
            ['designation_id' => 10, 'permission_id' => 111],
            ['designation_id' => 10, 'permission_id' => 112],
            ['designation_id' => 10, 'permission_id' => 113],
            ['designation_id' => 10, 'permission_id' => 114],
            ['designation_id' => 10, 'permission_id' => 115]
        ];
        for($i=10; $i>=5;$i--){
            foreach ($data as $d){
                DesignationPermission::create([
                    'designation_id'=> $i, 
                    'permission_id' => $d['permission_id']
                ]);
            }
        }
         

        // for all designation 
        for($i=4; $i>=2;$i--){
            foreach ($permissions as $permission){
                DesignationPermission::create([
                    'designation_id'=> $i, 
                    'permission_id' => $permission->id
                ]);
            }  
        } 
       
    }
}
