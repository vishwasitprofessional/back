<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DealOfDayssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\DealOfDay::factory(5)->create();
    }
}
