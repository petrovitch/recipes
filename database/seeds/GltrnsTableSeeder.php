<?php

use Illuminate\Database\Seeder;

class GltrnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        Gltrn::truncate();

        foreach (range(0,10) as $index) {
            Gltrn::insert([
                'acct' => $faker->numberBetween(10000000,99999999),
                'description' => $faker->sentence(3),
                'crj' => $faker->sentence(1),
                'date' => new DateTime,
                'document' => $faker->sentence(1),
                'amount' => 0,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]);
        }
    }
}
