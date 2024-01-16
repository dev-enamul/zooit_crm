<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('professions')->delete();
        
        $professions = [
            'Teacher',
            'Doctor',
            'Engineer',
            'Designer',
            'Accountant',
            'Writer', 
            'Police Officer',
            'Nurse',
            'Artist',
            'Entrepreneur', 
        ];
 
        foreach ($professions as $profession) {
            Profession::create(['name' => $profession]);
        } 
    }
}
