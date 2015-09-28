<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder {
    public function run()
    {
        $faker = \Faker\Factory::create();

        Roles::truncate();

        $roles = [
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'discription' => 'Manager',
                'created_at'       => new DateTime,
                'updated_at'       => new DateTime,
            ],
            [
                'name' => 'member',
                'display_name' => 'Member',
                'discription' => 'Member',
                'created_at'       => new DateTime,
                'updated_at'       => new DateTime,
            ],
        ];

        foreach ($roles as $role) {
            Roles::insert($role);
        }
    }
}
