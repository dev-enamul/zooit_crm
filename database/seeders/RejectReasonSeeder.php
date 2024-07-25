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

        DB::table('reject_reasons')->insert([
            ['name' => 'High Price'],
            ['name' => 'Lack of Budget'],
            ['name' => 'Timing Issues'],
            ['name' => 'Preference for Competitor'], 
            ['name' => 'Product Mismatch'],
            ['name' => 'Lack of Interest'], 
            ['name' => 'No Need'],
            ['name' => 'Poor Quality'],
            ['name' => 'Unresponsive Lead'],
            ['name' => 'Contractual Issues'],
            ['name' => 'Other'],
        ]); 
    }
}
