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
            ['slug' => 'employee-delete', 'name' => 'Employee Delete', 'status' => 1],
            ['slug' => 'product', 'name' => 'Product', 'status' => 1],
            ['slug' => 'product-manage', 'name' => 'Product Manage', 'status' => 1],
            ['slug' => 'product-delete', 'name' => 'Product Delete', 'status' => 1],
            ['slug' => 'freelancer', 'name' => 'Freelancer', 'status' => 1],
            ['slug' => 'freelancer-manage', 'name' => 'Freelancer Manage', 'status' => 1],
            ['slug' => 'freelancer-delete', 'name' => 'Freelancer Delete', 'status' => 1],
            ['slug' => 'customer', 'name' => 'Customer', 'status' => 1],
            ['slug' => 'customer-manage', 'name' => 'Customer Manage', 'status' => 1],
            ['slug' => 'customer-delete', 'name' => 'Customer Delete', 'status' => 1],
            ['slug' => 'prospecting', 'name' => 'Prospecting', 'status' => 1],
            ['slug' => 'prospecting-manage', 'name' => 'Prospecting Manage', 'status' => 1],
            ['slug' => 'prospecting-delete', 'name' => 'Prospecting Delete', 'status' => 1],
            ['slug' => 'cold-calling', 'name' => 'Cold Calling', 'status' => 1],
            ['slug' => 'cold-calling-manage', 'name' => 'Cold Calling Manage', 'status' => 1],
            ['slug' => 'cold-calling-delete', 'name' => 'Cold Calling Delete', 'status' => 1],
            ['slug' => 'lead', 'name' => 'Lead', 'status' => 1],
            ['slug' => 'lead-manage', 'name' => 'Lead Manage', 'status' => 1],
            ['slug' => 'lead-delete', 'name' => 'Lead Delete', 'status' => 1],
            ['slug' => 'lead-analysis', 'name' => 'Lead Analysis', 'status' => 1],
            ['slug' => 'lead-analysis-manage', 'name' => 'Lead Analysis Manage', 'status' => 1],
            ['slug' => 'lead-analysis-delete', 'name' => 'Lead Analysis Delete', 'status' => 1],
            ['slug' => 'presentation', 'name' => 'Presentation', 'status' => 1],
            ['slug' => 'presentation-manage', 'name' => 'Presentation Manage', 'status' => 1],
            ['slug' => 'presentation-delete', 'name' => 'Presentation Delete', 'status' => 1],
            ['slug' => 'visit-analysis', 'name' => 'Visit Analysis', 'status' => 1],
            ['slug' => 'visit-analysis-manage', 'name' => 'Visit Analysis Manage', 'status' => 1],
            ['slug' => 'visit-analysis-delete', 'name' => 'Visit Analysis Delete', 'status' => 1],
            ['slug' => 'follow-up', 'name' => 'Follow Up', 'status' => 1],
            ['slug' => 'follow-up-manage', 'name' => 'Follow Up Manage', 'status' => 1],
            ['slug' => 'follow-up-delete', 'name' => 'Follow Up Delete', 'status' => 1],
            ['slug' => 'follow-up-analysis', 'name' => 'Follow Up Analysis', 'status' => 1],
            ['slug' => 'follow-up-analysis-manage', 'name' => 'Follow Up Analysis Manage', 'status' => 1],
            ['slug' => 'follow-up-analysis-delete', 'name' => 'Follow Up Analysis Delete', 'status' => 1],
            ['slug' => 'negotiation', 'name' => 'Negotiation', 'status' => 1],
            ['slug' => 'negotiation-manage', 'name' => 'Negotiation Manage', 'status' => 1],
            ['slug' => 'negotiation-delete', 'name' => 'Negotiation Delete', 'status' => 1],
            ['slug' => 'negotiation-analysis', 'name' => 'Negotiation Analysis', 'status' => 1],
            ['slug' => 'negotiation-analysis-manage', 'name' => 'Negotiation Analysis Manage', 'status' => 1],
            ['slug' => 'negotiation-analysis-delete', 'name' => 'Negotiation Analysis Delete', 'status' => 1],
            ['slug' => 'rejection', 'name' => 'Rejection', 'status' => 1],
            ['slug' => 'rejection-manage', 'name' => 'Rejection Manage', 'status' => 1],
            ['slug' => 'rejection-delete', 'name' => 'Rejection Delete', 'status' => 1],
            ['slug' => 'sales', 'name' => 'Sales', 'status' => 1],
            ['slug' => 'sales-manage', 'name' => 'Sales Manage', 'status' => 1],
            ['slug' => 'sales-delete', 'name' => 'Sales Delete', 'status' => 1],
            ['slug' => 'sales-return', 'name' => 'Sales Return', 'status' => 1],
            ['slug' => 'sales-return-manage', 'name' => 'Sales Return Manage', 'status' => 1],
            ['slug' => 'sales-return-delete', 'name' => 'Sales Return Delete', 'status' => 1],
            ['slug' => 'sales-transfer', 'name' => 'Sales Transfer', 'status' => 1],
            ['slug' => 'sales-transfer-manage', 'name' => 'Sales Transfer Manage', 'status' => 1],
            ['slug' => 'sales-transfer-delete', 'name' => 'Sales Transfer Delete', 'status' => 1],
            ['slug' => 'deposit', 'name' => 'Deposit', 'status' => 1],
            ['slug' => 'deposit-manage', 'name' => 'Deposit Manage', 'status' => 1],
            ['slug' => 'deposit-delete', 'name' => 'Deposit Delete', 'status' => 1]
        ];

        DB::table('permissions')->insert($permissions);
    }
}
