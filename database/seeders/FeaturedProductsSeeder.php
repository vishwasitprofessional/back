<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FeaturedProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\FeaturedProduct::factory(5)->create();
    }
}
