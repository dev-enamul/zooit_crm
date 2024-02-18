<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApproveSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'employee',
            'product',
            'freelancer',
            'customer',
            'prospecting',
            'cold_calling',
            'lead',
            'lead_analysis',
            'presentation',
            'visit_analysis',
            'follow_up',
            'follow_up_analysis',
            'negotiation',
            'negotiation_analysis',
            'rejection',
            'salse',
            'salse_return',
        ];

        foreach ($data as $value) {
            DB::table('approve_settings')->insert([
                'name' => $value,
                'status' => 1,
            ]);
        }
    }
}
