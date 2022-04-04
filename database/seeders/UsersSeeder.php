<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'adogra2003@gmail.com',
                    'contact' => rand(10, 10000000000),
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'), // password
                    'remember_token' => Str::random(10),
                    'user_type' => 'admin'
                ],
                [
                    'name' => 'User',
                    'email' => 'user@user.com',
                    'contact' => rand(10, 10000000000),
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'), // password
                    'remember_token' => Str::random(10),
                    'user_type' => 'user'
                ],
                [
                    'name' => 'Vendor',
                    'email' => 'vendor@vendor.com',
                    'contact' => rand(10, 10000000000),
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'), // password
                    'remember_token' => Str::random(10),
                    'user_type' => 'vendor'
                ]
            ]
        );
    }
}
