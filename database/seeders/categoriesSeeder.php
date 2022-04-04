<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'title' => 'FOODWGAON',
                    'slug' => 'foodwgaon',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'is_parent' => 1,
                    'status' => 'active',
                    'parent_id' => null,
                    'image_url1' => 'SF_023.jpg',
                ],
                [
                    'title' => 'SWEETS',
                    'slug' => 'sweets',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'is_parent' => 0,
                    'status' => 'active',
                    'parent_id' => 1,
                    'image_url1' => 'SF_023.jpg',
                ],
                [
                    'title' => 'ORGANIC JAGGERY SWEETS',
                    'slug' => 'organic jaggery sweets',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'is_parent' => 0,
                    'status' => 'active',
                    'parent_id' => 1,
                    'image_url1' => 'SF_024.jpg',
                ],
                [
                    'title' => "HOT",
                    'slug' => 'hot',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'is_parent' => 0,
                    'status' => 'active',
                    'parent_id' => 1,
                    'image_url1' => 'SF_035.jpg',
                ],
                [
                    'title' => "NON-VEG PICKLE",
                    'slug' => 'non-veg-pickle',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'is_parent' => 0,
                    'status' => 'active',
                    'parent_id' => 1,
                    'image_url1' => 'SF_043.jpg',
                ],
                [
                    'title' => "VEG PICKLE",
                    'slug' => 'veg-pickle',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'is_parent' => 0,
                    'status' => 'active',
                    'parent_id' => 1,
                    'image_url1' => 'SF_058.jpg',
                ],
                [
                    'title' => "SPICES",
                    'slug' => 'spices',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'is_parent' => 0,
                    'status' => 'active',
                    'parent_id' => 1,
                    'image_url1' => 'SF_078.jpg',
                ],
                [
                    'title' => "MILLET SAVOURIES",
                    'slug' => 'millet-savouries',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'is_parent' => 0,
                    'status' => 'active',
                    'parent_id' => 1,
                    'image_url1' => 'SF_089.jpg',
                ],
                [
                    'title' => "DAIRY PRODUCTS",
                    'slug' => 'dairy-products',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'is_parent' => 0,
                    'status' => 'active',
                    'parent_id' => 1,
                    'image_url1' => 'SF_091.jpg',
                ],
            ]
        );
    }
}

