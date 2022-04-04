<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VarientFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('varient_filters')->insert(
            [
                [
                    'title' => '250gm',
                    'filter' => 'weight',
                    'cat_id' => 2,
                ],
                [
                    'title' => '500gm',
                    'filter' => 'weight',
                    'cat_id' => 2,
                ],
                [
                    'title' => '1kg',
                    'filter' => 'weight',
                    'cat_id' => 2,
                ],
                [
                    'title' => '250gm',
                    'filter' => 'weight',
                    'cat_id' => 3,
                ],
                [
                    'title' => '500gm',
                    'filter' => 'weight',
                    'cat_id' => 3,
                ],
                [
                    'title' => '1kg',
                    'filter' => 'weight',
                    'cat_id' => 3,
                ],
                [
                    'title' => '250gm',
                    'filter' => 'weight',
                    'cat_id' => 4,
                ],
                [
                    'title' => '500gm',
                    'filter' => 'weight',
                    'cat_id' => 4,
                ],
                [
                    'title' => '1kg',
                    'filter' => 'weight',
                    'cat_id' => 4,
                ],
                [
                    'title' => '250gm',
                    'filter' => 'weight',
                    'cat_id' => 5,
                ],
                [
                    'title' => '500gm',
                    'filter' => 'weight',
                    'cat_id' => 5,
                ],
                [
                    'title' => '1kg',
                    'filter' => 'weight',
                    'cat_id' => 5,
                ],
                [
                    'title' => '250gm',
                    'filter' => 'weight',
                    'cat_id' => 6,
                ],
                [
                    'title' => '500gm',
                    'filter' => 'weight',
                    'cat_id' => 6,
                ],
                [
                    'title' => '1kg',
                    'filter' => 'weight',
                    'cat_id' => 6,
                ],
                [
                    'title' => '250gm',
                    'filter' => 'weight',
                    'cat_id' => 7,
                ],
                [
                    'title' => '500gm',
                    'filter' => 'weight',
                    'cat_id' => 7,
                ],
                [
                    'title' => '1kg',
                    'filter' => 'weight',
                    'cat_id' => 7,
                ],
                [
                    'title' => '250gm',
                    'filter' => 'weight',
                    'cat_id' => 8,
                ],
                [
                    'title' => '500gm',
                    'filter' => 'weight',
                    'cat_id' => 8,
                ],
                [
                    'title' => '1kg',
                    'filter' => 'weight',
                    'cat_id' => 8,
                ],
                [
                    'title' => '250gm',
                    'filter' => 'weight',
                    'cat_id' => 9,
                ],
                [
                    'title' => '500gm',
                    'filter' => 'weight',
                    'cat_id' => 9,
                ],
                [
                    'title' => '1kg',
                    'filter' => 'weight',
                    'cat_id' => 9,
                ]
            ]
        );
    }
}
