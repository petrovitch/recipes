<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CategoryPostTableSeeder extends Seeder {
    public function run()
    {
        $faker = \Faker\Factory::create();

        db::table('category_post')->delete;
    }
}
