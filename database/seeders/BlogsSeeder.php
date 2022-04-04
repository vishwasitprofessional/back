<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->insert(
            [
                [
                    'title' => 'What is Lorem Ipsum?',
                    'description'=> "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                    'author_name' => 'Jone Doe',
                    'status' => 'show',
                    'image_url' => 'SF_0'.rand(01, 023) . '.jpg',
                ],
                [
                    'title' => 'Where can I get some?',
                    'description'=> "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                    'author_name' => 'Saraha Smith',
                    'status' => 'show',
                    'image_url' => 'SF_0'.rand(024, 033) . '.jpg',
                ],
                [
                    'title' => 'The standard Lorem Ipsum passage, used since the 1500s',
                    'description'=> "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                    'author_name' => 'Saraha Smith',
                    'status' => 'show',
                    'image_url' => 'SF_0'.rand(043, 053) . '.jpg',
                ],
                [
                    'title' => 'The standard Lorem Ipsum passage, used since the 1500s',
                    'description'=> "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                    'author_name' => 'Jone Doe',
                    'status' => 'show',
                    'image_url' => 'SF_0'.rand(071, 077). '.jpg',
                ]
            ]
        );
    }
}
