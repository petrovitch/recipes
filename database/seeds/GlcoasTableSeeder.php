<?php

use Illuminate\Database\Seeder;

class GlcoasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        Glcoa::truncate();

        foreach (range(0,10) as $index) {
            Glcoa::insert([
                'acct' => $faker->numberBetween(10000000,99999999),
                'title' => $faker->sentence(3),
                'init' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]);
        }
    }
}
