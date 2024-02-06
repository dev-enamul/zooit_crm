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
            ['slug' => 'product', 'name' => 'Product', 'status' => 1],
            ['slug' => 'product-manage', 'name' => 'Product Manage', 'status' => 1],
            ['slug' => 'product-delete', 'name' => 'Product Delete', 'status' => 1],
            ['slug' => 'product-approve', 'name' => 'Product Approve', 'status' => 1],
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
            ['slug' => 'deposit-delete', 'name' => 'Deposit Delete', 'status' => 1], 
            // progress 
            ['slug' => 'field-target', 'name' => 'Field Target', 'status' => 1], 
            ['slug' => 'daily-task', 'name' => 'Daily Task', 'status' => 1], 
            ['slug' => 'book-reading', 'name' => 'Book Reading', 'status' => 1], 
            ['slug' => 'deposit-target', 'name' => 'Deposit Target', 'status' => 1], 
            ['slug' => 'training', 'name' => 'Training', 'status' => 1],
            ['slug' => 'meeting', 'name' => 'Meeting', 'status' => 1],
            // report
            ['slug' => 'mst-commission', 'name' => 'MST Commission', 'status' => 1],
            ['slug' => 'fl-commission', 'name' => 'FL Commission', 'status' => 1],
            ['slug' => 'dt-achivement', 'name' => 'DT Achivement', 'status' => 1],
            ['slug' => 'special-offer', 'name' => 'Special Offer', 'status' => 1],
            ['slug' => 'due-report', 'name' => 'Due Report', 'status' => 1],
            ['slug' => 'sold-report', 'name' => 'Sold Report', 'status' => 1],
            ['slug' => 'cc-report', 'name' => 'CC Report', 'status' => 1],
            ['slug' => 'pending-report', 'name' => 'Pending Report', 'status' => 1],
            // setting
            ['slug' => 'setting', 'name' => 'Setting', 'status' => 1],
            ['slug' => 'profession', 'name' => 'Profession', 'status' => 1],
            ['slug' => 'profession-manage', 'name' => 'Profession Manage', 'status' => 1], 
            ['slug' => 'location', 'name' => 'Location', 'status' => 1],
            ['slug' => 'village', 'name' => 'Village', 'status' => 1],
            ['slug' => 'village-manage', 'name' => 'Village Manage', 'status' => 1],
            ['slug' => 'zone', 'name' => 'Zone', 'status' => 1],
            ['slug' => 'zone-manage', 'name' => 'Zone Manage', 'status' => 1],
            ['slug' => 'area', 'name' => 'Area', 'status' => 1],
            ['slug' => 'area-manage', 'name' => 'Area Manage', 'status' => 1], 
            ['slug' => 'unit', 'name' => 'Unit', 'status' => 1],
            ['slug' => 'unit-type', 'name' => 'Unit Type', 'status' => 1],
            ['slug' => 'unit-type-manage', 'name' => 'Unit Type Manage', 'status' => 1],
            ['slug' => 'unit-category', 'name' => 'Unit Category', 'status' => 1],
            ['slug' => 'unit-category-manage', 'name' => 'Unit Category Manage', 'status' => 1],
            ['slug' => 'training-category', 'name' => 'Training Category', 'status' => 1],
            ['slug' => 'training-category-manage', 'name' => 'Training Category Manage', 'status' => 1], 
            ['slug' => 'designation', 'name' => 'Designation', 'status' => 1],
            ['slug' => 'designation-manage', 'name' => 'Designation Manage', 'status' => 1],
            ['slug' => 'commission', 'name' => 'Commission', 'status' => 1],
            ['slug' => 'regular-commission', 'name' => 'Regular Commission', 'status' => 1],
            ['slug' => 'regular-commission-manage', 'name' => 'Regular Commission Manage', 'status' => 1],
            ['slug' => 'special-commission', 'name' => 'Special Commission', 'status' => 1],
            ['slug' => 'special-commission-manage', 'name' => 'Special Commission Manage', 'status' => 1],
            ['slug' => 'commission-deducation', 'name' => 'Commission Deducation', 'status' => 1],
            ['slug' => 'commission-deducation-manage', 'name' => 'Commission Deducation Manage', 'status' => 1],
            ['slug' => 'bank', 'name' => 'Bank', 'status' => 1],
            ['slug' => 'bank-manage', 'name' => 'Bank Manage', 'status' => 1],
            ['slug' => 'bank-day', 'name' => 'Bank Day', 'status' => 1],
            ['slug' => 'bank-day-manage', 'name' => 'Bank Day Manage', 'status' => 1],
            ['slug' => 'deposit-category', 'name' => 'Deposit Category', 'status' => 1],
            ['slug' => 'deposit-category-manage', 'name' => 'Deposit Category Manage', 'status' => 1],

            // Freelancer Approve 
            ['slug' => 'freelancer-counselling', 'name' => 'Freelancer Counselling', 'status' => 1],
            ['slug' => 'freelancer-interview', 'name' => 'Freelancer Interview', 'status' => 1],
            ['slug' => 'freelancer-meeting', 'name' => 'Freelancer Meeting', 'status' => 1],
            ['slug' => 'freelancer-training', 'name' => 'Freelancer Training', 'status' => 1],
            ['slug' => 'freelancer-remark', 'name' => 'Freelancer-Remark', 'status' => 1],
            
        ];

        DB::table('permissions')->insert($permissions);
    }
}
