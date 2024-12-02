<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['slug' => 'employee', 'name' => 'Employee', 'status' => 1],
            ['slug' => 'employee-manage', 'name' => 'Employee Manage', 'status' => 1],
            ['slug' => 'employee-permission', 'name' => 'Employee Permission', 'status' => 1],
            ['slug' => 'employee-delete', 'name' => 'Employee Delete', 'status' => 1], 
            ['slug' => 'lead', 'name' => 'Lead', 'status' => 1],
            ['slug' => 'lead-manage', 'name' => 'Lead Manage', 'status' => 1],
            ['slug' => 'lead-delete', 'name' => 'Lead Delete', 'status' => 1],  
            ['slug' => 'follow-up', 'name' => 'Follow Up', 'status' => 1],
            ['slug' => 'follow-up-manage', 'name' => 'Follow Up Manage', 'status' => 1],
            ['slug' => 'follow-up-delete', 'name' => 'Follow Up Delete', 'status' => 1], 
            ['slug' => 'rejection', 'name' => 'Rejection', 'status' => 1],
            ['slug' => 'rejection-manage', 'name' => 'Rejection Manage', 'status' => 1],
            ['slug' => 'rejection-delete', 'name' => 'Rejection Delete', 'status' => 1],
            ['slug' => 'sales', 'name' => 'Sales', 'status' => 1],
            ['slug' => 'sales-manage', 'name' => 'Sales Manage', 'status' => 1],
            ['slug' => 'sales-delete', 'name' => 'Sales Delete', 'status' => 1], 
            ['slug' => 'deposit', 'name' => 'Deposit', 'status' => 1],
            ['slug' => 'deposit-manage', 'name' => 'Deposit Manage', 'status' => 1],
            ['slug' => 'meeting', 'name' => 'Meeting', 'status' => 1],
            ['slug' => 'meeting-manage', 'name' => 'Meeting Manage', 'status' => 1],
            ['slug' => 'meeting-delete', 'name' => 'Meeting Delete', 'status' => 1], 
            ['slug' => 'invoice', 'name' => 'Invoice', 'status' => 1],
            ['slug' => 'invoice-manage', 'name' => 'Invoice Manage', 'status' => 1],
            ['slug' => 'invoice-delete', 'name' => 'Invoice Delete', 'status' => 1], 
            ['slug' => 'setting', 'name' => 'Setting', 'status' => 1], 
            ['slug' => 'designation-setting', 'name' => 'Lead Setting', 'status' => 1], 
            ['slug' => 'bank-setting', 'name' => 'Bank Setting', 'status' => 1],  
            
            ['slug' => 'service-setting', 'name' => 'Service Setting', 'status' => 1],
            ['slug' => 'lead-source-setting', 'name' => 'Lead Source Setting', 'status' => 1],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
