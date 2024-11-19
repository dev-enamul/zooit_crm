<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'service' => 'Web Development',
                'slug' => Str::slug('Web Development'),
                'description' => 'Custom and responsive web development services tailored to your business needs.',
            ],
            [
                'service' => 'Mobile App Development',
                'slug' => Str::slug('Mobile App Development'),
                'description' => 'Design and development of user-friendly mobile apps for Android and iOS platforms.',
            ],
            [
                'service' => 'E-Commerce Solutions',
                'slug' => Str::slug('E-Commerce Solutions'),
                'description' => 'Complete e-commerce solutions with secure payment gateways and seamless user experience.',
            ],
            [
                'service' => 'SEO and Digital Marketing',
                'slug' => Str::slug('SEO and Digital Marketing'),
                'description' => 'SEO strategies and digital marketing campaigns to improve online visibility and growth.',
            ],
            [
                'service' => 'Custom Software Development',
                'slug' => Str::slug('Custom Software Development'),
                'description' => 'Bespoke software solutions designed to automate workflows and enhance productivity.',
            ],
        ];

        DB::table('services')->insert($services);
    }
}
