<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->caption = 'It is the first ever caption and post on this application. Have fun ahead.';
        $post->save();

        $post1 = new Post;
        $post1->caption = 'Oh my god! It is day one of 2023.';
        $post1->save();
    }
}
