<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder {
    public function run()
    {
        DB::table('posts')->delete();

        $posts = [
            [
                'title' => 'Sample Title Post',
                'content' => 'This is a test.',
                'slug' => null,
                'status' => 1,
                'user_id' => 1,
            ]
        ];

        foreach ($posts as $post) {
            User::create($post);
        }
    }
}