<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class TicketsTableSeeder extends Seeder {
    public function run()
    {
        $faker = \Faker\Factory::create();

        Tickets::truncate();

        foreach (range(1,100) as $index) {
            Tickets::insert([
                'title' => $faker->unique()->sentence(3),
                'content' => $faker->sentence(10),
                'slug' => $faker->unique()->shuffle('0123456789abc'),
                'status' => $faker->boolean(50),
                'user_id' => $faker->numberBetween(1,100),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]);
        }
    }
}