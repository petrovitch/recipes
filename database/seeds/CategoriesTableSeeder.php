<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoriesTableSeeder extends Seeder {
    public function run()
    {
        DB::table('categories')->delete();

        $categories = [
            [
                'name' => 'News'
            ],
            [
                'name' => 'Laravel'
            ]
        ];

        foreach ($categories as $category) {
            User::create($category);
        }
    }
}