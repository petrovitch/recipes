<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        User::truncate();

//        DB::table('users')->insert([

        User::insert([
            [
                'name' => 'Kenn E. Thompson',
                'email' => 'kennthompson@gmail.com',
                'password' => bcrypt('abc123'),
                'created_at'       => new DateTime,
                'updated_at'       => new DateTime,
            ],
        ]);

        foreach (range(1,99) as $index) {
            User::insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'created_at' => dateTime($max = 'now'),
                'updated_at' => dateTime($max = 'now'),
            ]);
        }
    }
}