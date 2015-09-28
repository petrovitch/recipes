<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('categories')->delete();

        DB::table('categories')->insert([
            [
                'name' => 'News',
                'created_at'       => new DateTime,
                'updated_at'       => new DateTime,
            ],
        ]);
    }
}