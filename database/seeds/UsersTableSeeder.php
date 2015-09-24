<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Kenn E. Thompson',
                'email' => 'kennthompson@gmail.com',
                'password' => bcrypt('abc123'),
                'created_at'       => new DateTime,
                'updated_at'       => new DateTime,
            ],
        ]);

        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'created_at' => dateTime($max = 'now'),
                'updated_at' => dateTime($max = 'now'),
            ]);
        }
    }
}
