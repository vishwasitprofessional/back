<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(categoriesSeeder::class);
        $this->call(GeneralSettingsSeeder::class);
        $this->call(VarientFilterSeeder::class);
        //$this->call(ProductsSeeder::class);
        // $this->call(DealOfDayssSeeder::class);
        // $this->call(FeaturedProductsSeeder::class);
        // $this->call(PopularProductsSeeder::class);
        $this->call(bannersSeeder::class);
        // $this->call(BlogsSeeder::class);
        $this->call(SlidersSeeder::class);
    }
}
