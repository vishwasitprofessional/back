<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert(
            [
                [
                    'title' => 'SWEETS',
                    'sub_title' => 'SWEETS',
                    'short_description'=>'Contrary to popular belief',
                    'status' => 'show',
                    'image_url' => 'SWEETS.png',
                ],
                [
                    'title' => 'SAVOURY',
                    'sub_title' => "Savoury",
                    'short_description'=>'Contrary to popular belief',
                    'status' => 'show',
                    'image_url' => 'Savoury.png',
                ],
                [
                    'title' => 'VEG PICKLE',
                    'sub_title' => "VEG PICKLE",
                    'short_description'=>'Contrary to popular belief',
                    'status' => 'show',
                    'image_url' => 'Pickles.png',
                ],
                [
                    'title' => 'SPICES',
                    'sub_title' => "SPICES",
                    'short_description'=>'Contrary to popular belief',
                    'status' => 'show',
                    'image_url' => 'SPICES.png',
                ],
                [
                    'title' => 'DAIRY',
                    'sub_title' => "Dairy",
                    'short_description'=>'Contrary to popular belief',
                    'status' => 'show',
                    'image_url' => 'Dairy.png',
                ]
            ]
        );
    }
}
