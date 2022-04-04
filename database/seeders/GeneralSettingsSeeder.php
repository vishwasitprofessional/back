<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->insert([
            'title' => 'Sweets Online Shopping',
            'meta_description' => 'Sweets Online Shopping',
            'meta_keywords' => 'Sweets, Online Shopping, Sweets Website',
            'logo' => 'logo.png',
            'favicon' => 'logo.png',
            'address' => 'address',
            'email' => 'test@test.com',
            'phone' => '5264598756',
            'fax' => '(888) 123-4567',
            'footer' => 'Sweets Online Websie',
            'footer_url' => 'https:://www.xyz.com',
            'facebook_url' => '',
            'twitter_url' => '',
            'linkedin_url' => '',
            'pinterest_url' => '',
            'youtube_url' => '',
            'cat_id'=>1,
        ]);
    }
}
