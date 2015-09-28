<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder {
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('comments')->delete();

    }
}