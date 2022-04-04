<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert(
            [
                [
                    'title' => 'SWEETS',
                    'slug' => 'sweets',
                    'status' => 'active',
                    'image_url' => 'SF_0'.rand(01, 023) . '.jpg',
                ],
                [
                    'title' => 'ORGANIC JAGGERY SWEETS',
                    'slug' => 'organic jaggery sweets',
                    'status' => 'active',
                    'image_url' => 'SF_0'.rand(024, 033) . '.jpg',
                ],
                [
                    'title' => 'NON-VEG PICKLE',
                    'slug' => 'non-veg-pickle',
                    'status' => 'active',
                    'image_url' => 'SF_0'.rand(043, 053) . '.jpg',
                ],
                [
                    'title' => 'SPICES',
                    'slug' => 'spices',
                    'status' => 'active',
                    'image_url' => 'SF_0'.rand(071, 077). '.jpg',
                ],
                [
                    'title' => 'VEG PICKLE',
                    'slug' => 'veg-pickle',
                    'status' => 'active',
                    'image_url' => 'SF_0'.rand(054, 070) . '.jpg',
                ]
            ]
        );
    }
}
