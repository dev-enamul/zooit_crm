<?php

namespace Database\Seeders;

use App\Models\RejectReason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RejectReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reject_reasons')->delete();

        DB::table('rejection_reasons')->insert([
            ['reason' => 'High Price'],
            ['reason' => 'Lack of Budget'],
            ['reason' => 'Product Mismatch'],
            ['reason' => 'Lack of Interest'],
            ['reason' => 'Preference for Competitor'],
            ['reason' => 'Timing Issues'],
            ['reason' => 'No Need'],
            ['reason' => 'Poor Quality'],
            ['reason' => 'Unresponsive Lead'],
            ['reason' => 'Contractual Issues'],
            ['reason' => 'Other'],
        ]); 
    }
}
