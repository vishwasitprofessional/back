<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class bannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert(
            [
                [
                    'title' => 'SWEET',
                    'sub_title' => 'SWEET',
                    'link_title' => 'Buy Now',
                    'link_url' => '#',
                    'status' => 'active',
                    'image_url' => 'SWEET.png',
                ],
                [
                    'title' => 'ORGANIC JAGGERY SWEETS',
                    'sub_title' => "ORGANIC JAGGERY SWEETS",
                    'link_title' => 'Buy Now',
                    'link_url' => '#',
                    'status' => 'active',
                    'image_url' => 'ORGANIC-JAGGERY-SWEETS.png',
                ],
                [
                    'title' => 'NON-VEG PICKLE',
                    'sub_title' => 'NON-VEG PICKLE',
                    'link_title' => 'Buy Now',
                    'link_url' => '#',
                    'status' => 'active',
                    'image_url' => 'NON-VEG-PICKLE.png',
                ],
                [
                    'title' => 'SPICES',
                    'sub_title' => 'SPICES',
                    'link_title' => 'Buy Now',
                    'link_url' => '#',
                    'status' => 'active',
                    'image_url' => 'SPICES.png',
                ],
                [
                    'title' => 'DAIRY',
                    'sub_title' => 'Dairy',
                    'link_title' => 'Buy Now',
                    'link_url' => '#',
                    'status' => 'active',
                    'image_url' => 'DAIRY.png',
                ],
                [
                    'title' => 'SWEETS',
                    'sub_title' => 'SWEETS',
                    'link_title' => 'Buy Now',
                    'link_url' => '#',
                    'status' => 'active',
                    'image_url' => 'SWEETS.png',
                ]
            ]
        );
    }
}
