<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {
    public function run()
    {
        DB::table('categories')->delete();

        $categories = [
            [
                'name' => 'News',
                'created_at'       => new DateTime,
                'updated_at'       => new DateTime,
            ],
            [
                'name' => 'Laravel',
                'created_at'       => new DateTime,
                'updated_at'       => new DateTime,
            ],
        ];

        foreach ($categories as $category) {
            User::create($category);
        }
    }
}