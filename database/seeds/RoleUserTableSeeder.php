<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class RoleUserTableSeeder extends Seeder {
    public function run()
    {
        DB::table('role_user')->delete();

        $rolesUsers = [
            [
                'user_id' => 1,
                'role_id' => 1,
                'created_at'       => new DateTime,
                'updated_at'       => new DateTime,
            ],
        ];

        foreach ($rolesUsers as $roleUser) {
            User::create($roleUser);
        }
    }
}