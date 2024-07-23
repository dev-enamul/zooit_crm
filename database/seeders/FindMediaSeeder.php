<?php

namespace Database\Seeders;

use App\Models\FindMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FindMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('find_media')->delete(); 
        $medias = [
            'Facebook Campaign',
            'Linkedin Campaign',
            'Direct Visit',
        ];
 
        foreach ($medias as $media) {
            $model = new FindMedia();
            $model::create(['name' => $media,'slug'=>$media]);
        } 
    }
}
