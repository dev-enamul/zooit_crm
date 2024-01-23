<?php

namespace Database\Seeders;

use App\Models\NegotiationWaitingDay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NegotiationWaitingDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        NegotiationWaitingDay::create([
            'waiting_day'=> 7
        ]);
    }
}
